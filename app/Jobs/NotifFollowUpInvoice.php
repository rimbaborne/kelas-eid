<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;
use Throwable;
use Illuminate\Support\Facades\Mail;
use App\Mail\Pemesanan;

class NotifFollowUpInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $transaction, $transactionId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    public function notifwa($nomorhp, $isipesan)
    {
        $datawa = json_decode($isipesan);

        $apikey     = env('WAHA_API_KEY');
        $url        = env('WAHA_API_URL');
        $sessionApi = env('WAHA_API_SESSION');
        $requestApi = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
            'X-Api-Key'    => $apikey,
        ]);

        try {
            #1 Send Seen
            $requestApi->post($url.'/api/sendSeen', [ "session" => $sessionApi, "chatId"  => $nomorhp.'@c.us', ]);

            #2 Start Typing
            $requestApi->post($url.'/api/startTyping', [ "session" => $sessionApi, "chatId"  => $nomorhp.'@c.us', ]);

            sleep(1); // jeda seolah olah ngetik

            #3 Stop Typing
            $requestApi->post($url.'/api/stopTyping', [ "session" => $sessionApi, "chatId"  => $nomorhp.'@c.us', ]);

            #4 Send Message
            $requestApi->post($url.'/api/sendText', [
                "session" => $sessionApi,
                "chatId"  => $nomorhp.'@c.us',
                "text"    => $isipesan,
            ]);
        } catch (Throwable $th) {
            throw $th;
        }
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Ambil data transaksi terbaru dari database
        $transaction = Transaction::find($this->transactionId);

        // Cek status pembayaran
        if ($transaction && $transaction->status_pembayaran == 'unpaid') {
            $isiwa = 'Halo '.$transaction->user->name.',

Kurang dari 6 jam lagi invoice pemesanan Kelas Online Profit 10 juta Anda akan segera hangus.
Untuk segera dapat akses kelasnya silahkan segera selesaikan transaksi Anda di '.route('pemesanan.invoice', ['uuid' => $transaction->uuid]).'

Salam,

*Tim entrepreneurID*

Nb : Jika Anda ada pertanyaan, silahkan balas chat ini. 🙂';

            $this->notifwa($transaction->user->phone_code . $transaction->user->phone_number, $isiwa);

            $isiemail = 'Dear '.$transaction->user->name.', <br><br>

Kurang dari 6 jam lagi invoice pemesanan Kelas Online Profit 10 juta Anda akan segera hangus. <br>
Untuk segera dapat akses kelasnya silahkan segera selesaikan transaksi Anda di '.route('pemesanan.invoice', ['uuid' => $transaction->uuid]).' <br><br>


Salam,<br><br>

Tim entrepreneurID <br><br>

Nb : Jika Anda ada pertanyaan, silahkan hubungi Customer Support kami di link ini ➡️ bit.ly/CS-eID';

            $data = [
                'subject'  => '[Invoice Pendaftaran Kelas 10 Juta]',
                'isi' => $isiemail,
            ];

            Mail::to($transaction->user->email)->send(new Pemesanan($data));


        }
    }
}
