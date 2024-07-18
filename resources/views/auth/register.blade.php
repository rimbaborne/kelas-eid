@extends('website.layouts.pembayaran')

@section('content')
    <div class="text-center py-8 bg-gray-100">
        <p class="text-sm text-gray-600">
            <Link href="{{ url('/') }}" class="text-md text-gray-600 hover:text-gray-900">
                &larr; Kembali
            </Link>
        </p>
    </div>

    <x-auth-card>
        <h1 class="text-2xl font-bold text-center py-4">Pemesanan</h1>
        <div class="flex flex-col border justify-center bg-white rounded-xl items-center mb-4">
            <div class="rounded-lg bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4">
                <div class="space-y-2 flex items-center justify-between gap-6 md:space-y-0">
                    <a href="#" class="shrink-0">
                        <img class="w-28 p-2 sm:p-3" src="https://admin.entrepreneurid.org/img/produk/KPS-2024-1.png">
                    </a>

                    <div class="w-full min-w-0 flex-1 space-y-2 md:max-w-md">
                        <h1 class="text-xl font-semibold text-gray-900 hover:underline dark:text-white">
                            Kelas Profit 10 Juta
                        </h1>
                        <h1 class="text-lg font-semibold text-gray-900 hover:underline dark:text-white">
                            Rp. 57.000
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <x-splade-form action="{{ route('register') }}" class="space-y-4"
            confirm-text="Apakah data yang anda masukkan sudah benar ?" confirm="Konfirmasi" confirm-button="Benar"
            cancel-button="Belum" method="POST">
            <x-splade-input id="name" type="text" name="name" :label="__('Nama')" required autofocus />
            <x-splade-input id="email" type="email" name="email" :label="__('Email')" required />
            <div class="flex items-center">
                <x-splade-select name="phone_code" :label="__('Nomor HP Whatsapp')" value="62" class="py-0 w-60 text-sm block" choices
                    required>
                    <option value="62">🇮🇩 Indonesia</option>
                    <option value="60">🇲🇾 Malaysia</option>
                    <option value="65">🇸🇬 Singapore</option>
                    <option value="852">🇭🇰 Hong Kong</option>
                    <option value="82">🇰🇷 Korea</option>
                    <option value="81">🇯🇵 Japan</option>
                    <option value="93">Afghanistan (+93)</option>
                    <option value="355">Albania (+355)</option>
                    <option value="213">Algeria (+213)</option>
                    <option value="1684">American Samoa (+1684)</option>
                    <option value="376">Andorra (+376)</option>
                    <option value="244">Angola (+244)</option>
                    <option value="1264">Anguilla (+1264)</option>
                    <option value="672">Antarctica (+672)</option>
                    <option value="1268">Antigua and Barbuda (+1268)</option>
                    <option value="54">Argentina (+54)</option>
                    <option value="374">Armenia (+374)</option>
                    <option value="297">Aruba (+297)</option>
                    <option value="61">Australia (+61)</option>
                    <option value="43">Austria (+43)</option>
                    <option value="994">Azerbaijan (+994)</option>
                    <option value="1242">Bahamas (+1242)</option>
                    <option value="973">Bahrain (+973)</option>
                    <option value="880">Bangladesh (+880)</option>
                    <option value="1246">Barbados (+1246)</option>
                    <option value="375">Belarus (+375)</option>
                    <option value="32">Belgium (+32)</option>
                    <option value="501">Belize (+501)</option>
                    <option value="229">Benin (+229)</option>
                    <option value="1441">Bermuda (+1441)</option>
                    <option value="975">Bhutan (+975)</option>
                    <option value="591">Bolivia (+591)</option>
                    <option value="387">Bosnia and Herzegovina (+387)</option>
                    <option value="267">Botswana (+267)</option>
                    <option value="55">Brazil (+55)</option>
                    <option value="246">British Indian Ocean Territory (+246)</option>
                    <option value="1284">British Virgin Islands (+1284)</option>
                    <option value="673">Brunei (+673)</option>
                    <option value="359">Bulgaria (+359)</option>
                    <option value="226">Burkina Faso (+226)</option>
                    <option value="257">Burundi (+257)</option>
                    <option value="855">Cambodia (+855)</option>
                    <option value="237">Cameroon (+237)</option>
                    <option value="1">Canada (+1)</option>
                    <option value="238">Cape Verde (+238)</option>
                    <option value="1345">Cayman Islands (+1345)</option>
                    <option value="236">Central African Republic (+236)</option>
                    <option value="235">Chad (+235)</option>
                    <option value="56">Chile (+56)</option>
                    <option value="86">China (+86)</option>
                    <option value="61">Christmas Island (+61)</option>
                    <option value="61">Cocos Islands (+61)</option>
                    <option value="57">Colombia (+57)</option>
                    <option value="269">Comoros (+269)</option>
                    <option value="682">Cook Islands (+682)</option>
                    <option value="506">Costa Rica (+506)</option>
                    <option value="385">Croatia (+385)</option>
                    <option value="53">Cuba (+53)</option>
                    <option value="599">Curacao (+599)</option>
                    <option value="357">Cyprus (+357)</option>
                    <option value="420">Czech Republic (+420)</option>
                    <option value="243">Democratic Republic of the Congo (+243)</option>
                    <option value="45">Denmark (+45)</option>
                    <option value="253">Djibouti (+253)</option>
                    <option value="1767">Dominica (+1767)</option>
                    <option value="1809">Dominican Republic (+1809)</option>
                    <option value="670">East Timor (+670)</option>
                    <option value="593">Ecuador (+593)</option>
                    <option value="20">Egypt (+20)</option>
                    <option value="503">El Salvador (+503)</option>
                    <option value="240">Equatorial Guinea (+240)</option>
                    <option value="291">Eritrea (+291)</option>
                    <option value="372">Estonia (+372)</option>
                    <option value="251">Ethiopia (+251)</option>
                    <option value="500">Falkland Islands (+500)</option>
                    <option value="298">Faroe Islands (+298)</option>
                    <option value="679">Fiji (+679)</option>
                    <option value="358">Finland (+358)</option>
                    <option value="33">France (+33)</option>
                    <option value="689">French Polynesia (+689)</option>
                    <option value="241">Gabon (+241)</option>
                    <option value="220">Gambia (+220)</option>
                    <option value="995">Georgia (+995)</option>
                    <option value="49">Germany (+49)</option>
                    <option value="233">Ghana (+233)</option>
                    <option value="350">Gibraltar (+350)</option>
                    <option value="30">Greece (+30)</option>
                    <option value="299">Greenland (+299)</option>
                    <option value="1473">Grenada (+1473)</option>
                    <option value="1671">Guam (+1671)</option>
                    <option value="502">Guatemala (+502)</option>
                    <option value="44-1481">Guernsey (+44-1481)</option>
                    <option value="224">Guinea (+224)</option>
                    <option value="245">Guinea-Bissau (+245)</option>
                    <option value="592">Guyana (+592)</option>
                    <option value="509">Haiti (+509)</option>
                    <option value="504">Honduras (+504)</option>
                    <option value="852">Hong Kong (+852)</option>
                    <option value="36">Hungary (+36)</option>
                    <option value="354">Iceland (+354)</option>
                    <option value="91">India (+91)</option>
                    <option value="98">Iran (+98)</option>
                    <option value="964">Iraq (+964)</option>
                    <option value="353">Ireland (+353)</option>
                    <option value="44-1624">Isle of Man (+44-1624)</option>
                    <option value="39">Italy (+39)</option>
                    <option value="225">Ivory Coast (+225)</option>
                    <option value="1876">Jamaica (+1876)</option>
                    <option value="81">Japan (+81)</option>
                    <option value="44-1534">Jersey (+44-1534)</option>
                    <option value="962">Jordan (+962)</option>
                    <option value="7">Kazakhstan (+7)</option>
                    <option value="254">Kenya (+254)</option>
                    <option value="686">Kiribati (+686)</option>
                    <option value="383">Kosovo (+383)</option>
                    <option value="965">Kuwait (+965)</option>
                    <option value="996">Kyrgyzstan (+996)</option>
                    <option value="856">Laos (+856)</option>
                    <option value="371">Latvia (+371)</option>
                    <option value="961">Lebanon (+961)</option>
                    <option value="266">Lesotho (+266)</option>
                    <option value="231">Liberia (+231)</option>
                    <option value="218">Libya (+218)</option>
                    <option value="423">Liechtenstein (+423)</option>
                    <option value="370">Lithuania (+370)</option>
                    <option value="352">Luxembourg (+352)</option>
                    <option value="853">Macau (+853)</option>
                    <option value="389">Macedonia (+389)</option>
                    <option value="261">Madagascar (+261)</option>
                    <option value="265">Malawi (+265)</option>
                    <option value="960">Maldives (+960)</option>
                    <option value="223">Mali (+223)</option>
                    <option value="356">Malta (+356)</option>
                    <option value="692">Marshall Islands (+692)</option>
                    <option value="222">Mauritania (+222)</option>
                    <option value="230">Mauritius (+230)</option>
                    <option value="262">Mayotte (+262)</option>
                    <option value="52">Mexico (+52)</option>
                    <option value="691">Micronesia (+691)</option>
                    <option value="373">Moldova (+373)</option>
                    <option value="377">Monaco (+377)</option>
                    <option value="976">Mongolia (+976)</option>
                    <option value="382">Montenegro (+382)</option>
                    <option value="1664">Montserrat (+1664)</option>
                    <option value="212">Morocco (+212)</option>
                    <option value="258">Mozambique (+258)</option>
                    <option value="95">Myanmar (+95)</option>
                    <option value="264">Namibia (+264)</option>
                    <option value="674">Nauru (+674)</option>
                    <option value="977">Nepal (+977)</option>
                    <option value="31">Netherlands (+31)</option>
                    <option value="599">Netherlands Antilles (+599)</option>
                    <option value="687">New Caledonia (+687)</option>
                    <option value="64">New Zealand (+64)</option>
                    <option value="505">Nicaragua (+505)</option>
                    <option value="227">Niger (+227)</option>
                    <option value="234">Nigeria (+234)</option>
                    <option value="683">Niue (+683)</option>
                    <option value="850">North Korea (+850)</option>
                    <option value="1670">Northern Mariana Islands (+1670)</option>
                    <option value="47">Norway (+47)</option>
                    <option value="968">Oman (+968)</option>
                    <option value="92">Pakistan (+92)</option>
                    <option value="680">Palau (+680)</option>
                    <option value="970">Palestine (+970)</option>
                    <option value="507">Panama (+507)</option>
                    <option value="675">Papua New Guinea (+675)</option>
                    <option value="595">Paraguay (+595)</option>
                    <option value="51">Peru (+51)</option>
                    <option value="63">Philippines (+63)</option>
                    <option value="64">Pitcairn (+64)</option>
                    <option value="48">Poland (+48)</option>
                    <option value="351">Portugal (+351)</option>
                    <option value="1787">Puerto Rico (+1787)</option>
                    <option value="974">Qatar (+974)</option>
                    <option value="242">Republic of the Congo (+242)</option>
                    <option value="262">Reunion (+262)</option>
                    <option value="40">Romania (+40)</option>
                    <option value="7">Russia (+7)</option>
                    <option value="250">Rwanda (+250)</option>
                    <option value="590">Saint Barthelemy (+590)</option>
                    <option value="290">Saint Helena (+290)</option>
                    <option value="1869">Saint Kitts and Nevis (+1869)</option>
                    <option value="1758">Saint Lucia (+1758)</option>
                    <option value="590">Saint Martin (+590)</option>
                    <option value="508">Saint Pierre and Miquelon (+508)</option>
                    <option value="1784">Saint Vincent and the Grenadines (+1784)</option>
                    <option value="685">Samoa (+685)</option>
                    <option value="378">San Marino (+378)</option>
                    <option value="239">Sao Tome and Principe (+239)</option>
                    <option value="966">Saudi Arabia (+966)</option>
                    <option value="221">Senegal (+221)</option>
                    <option value="381">Serbia (+381)</option>
                    <option value="248">Seychelles (+248)</option>
                    <option value="232">Sierra Leone (+232)</option>
                    <option value="1721">Sint Maarten (+1721)</option>
                    <option value="421">Slovakia (+421)</option>
                    <option value="386">Slovenia (+386)</option>
                    <option value="677">Solomon Islands (+677)</option>
                    <option value="252">Somalia (+252)</option>
                    <option value="27">South Africa (+27)</option>
                    <option value="82">South Korea (+82)</option>
                    <option value="211">South Sudan (+211)</option>
                    <option value="34">Spain (+34)</option>
                    <option value="94">Sri Lanka (+94)</option>
                    <option value="249">Sudan (+249)</option>
                    <option value="597">Suriname (+597)</option>
                    <option value="47">Svalbard and Jan Mayen (+47)</option>
                    <option value="268">Swaziland (+268)</option>
                    <option value="46">Sweden (+46)</option>
                    <option value="41">Switzerland (+41)</option>
                    <option value="963">Syria (+963)</option>
                    <option value="886">Taiwan (+886)</option>
                    <option value="992">Tajikistan (+992)</option>
                    <option value="255">Tanzania (+255)</option>
                    <option value="66">Thailand (+66)</option>
                    <option value="228">Togo (+228)</option>
                    <option value="690">Tokelau (+690)</option>
                    <option value="676">Tonga (+676)</option>
                    <option value="1868">Trinidad and Tobago (+1868)</option>
                    <option value="216">Tunisia (+216)</option>
                    <option value="90">Turkey (+90)</option>
                    <option value="993">Turkmenistan (+993)</option>
                    <option value="1649">Turks and Caicos Islands (+1649)</option>
                    <option value="688">Tuvalu (+688)</option>
                    <option value="1340">U.S. Virgin Islands (+1340)</option>
                    <option value="256">Uganda (+256)</option>
                    <option value="380">Ukraine (+380)</option>
                    <option value="971">United Arab Emirates (+971)</option>
                    <option value="44">United Kingdom (+44)</option>
                    <option value="1">United States (+1)</option>
                    <option value="598">Uruguay (+598)</option>
                    <option value="998">Uzbekistan (+998)</option>
                    <option value="678">Vanuatu (+678)</option>
                    <option value="379">Vatican (+379)</option>
                    <option value="58">Venezuela (+58)</option>
                    <option value="84">Vietnam (+84)</option>
                    <option value="681">Wallis and Futuna (+681)</option>
                    <option value="212">Western Sahara (+212)</option>
                    <option value="967">Yemen (+967)</option>
                    <option value="260">Zambia (+260)</option>
                    <option value="263">Zimbabwe (+263)</option>
                </x-splade-select>
            </div>
            <div class="flex items-center">
                <div class="relative w-full">
                    <x-splade-input type="tel" name="phone_number" size="20" minlength="8" maxlength="15"
                        class="block px-0 w-full text-center italic text-3xl text-gray-900 bg-transparent appearance-none peer"
                        placeholder="Masukkan Nomor : 08123456xxxx" required />
                </div>
            </div>
            <div class="flex items-center justify-end ">
                <div class="text-sm text-gray-500">
                    Contoh : 08123456789
                </div>
            </div>
            <x-splade-input id="password" type="password" name="password" min="6"
                placeholder="Password Minimal 6 Karakter" :label="__('Password (untuk login member area nanti)')" required autocomplete="new-password" />

            <div class="container mx-auto py-8">
                <div class="max-w-lg mx-auto bg-white rounded-lg ">
                    <h2 class="text-2xl font-bold mb-6 text-center">Pilih Metode Pembayaran</h2>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-2">Virtual Account (VA)</h3>
                        <div class="space-y-2">
                            <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="bca" class="mr-2" data-fee="3500" data-name="Bank BSI">
                                <img src="{{ url('/') }}/assets/pembayaran/bsi.png" alt="Bank BCA" class="h-6 mr-2">
                                Bank BSI
                            </label>
                            <label class="flex items-center p-4  border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="bca" class="mr-2" data-fee="3500" data-name="Bank Muamalat">
                                <img src="{{ url('/') }}/assets/pembayaran/bmi.png" alt="Bank BCA" class="h-6 mr-2">
                                Bank Muamalat
                            </label>
                            <label class="flex items-center p-4  border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="bca" class="mr-2" data-fee="4000" data-name="Bank BCA">
                                <img src="{{ url('/') }}/assets/pembayaran/bank_bca.png" alt="Bank BCA"
                                    class="h-6 mr-2">
                                Bank BCA
                            </label>
                            <label class="flex items-center p-4  border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="bni" class="mr-2" data-fee="3500" data-name="Bank BNI">
                                <img src="{{ url('/') }}/assets/pembayaran/bank_bni.png" alt="Bank BNI"
                                    class="h-6 mr-2">
                                Bank BNI
                            </label>
                            <label class="flex items-center p-4  border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="bri" class="mr-2" data-fee="3500" data-name="Bank BRI">
                                <img src="{{ url('/') }}/assets/pembayaran/bank_bri.png" alt="Bank BRI"
                                    class="h-6 mr-2">
                                Bank BRI
                            </label>
                            <label class="flex items-center p-4  border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="mandiri" class="mr-2" data-fee="3500" data-name="Bank Mandiri">
                                <img src="{{ url('/') }}/assets/pembayaran/bank_mandiri.png" alt="Bank Mandiri"
                                    class="h-6 mr-2">
                                Bank MANDIRI
                            </label>
                            <label class="flex items-center p-4  border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="permata" class="mr-2" data-fee="3500" data-name="Bank Permata">
                                <img src="{{ url('/') }}/assets/pembayaran/bank_permata.png" alt="Bank Permata"
                                    class="h-6 mr-2">
                                Bank PERMATA
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold mb-2">e-Wallet</h3>
                        <div class="space-y-2">
                            <label class="flex items-center p-4  border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="linkaja" class="mr-2" data-fee="{{ 57000 * 0.007 }}" data-name="LinkAja">
                                <img src="{{ url('/') }}/assets/pembayaran/linkaja.svg" alt="LinkAja"
                                    class="h-6 mr-2">
                                LinkAja
                            </label>
                            <label class="flex items-center p-4  border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="dana" class="mr-2" data-fee="{{ 57000 * 0.007 }}" data-name="Dana">
                                <img src="{{ url('/') }}/assets/pembayaran/dana.svg" alt="Dana"
                                    class="h-6 mr-2">
                                Dana
                            </label>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-2">QR Code</h3>
                        <div class="space-y-2">
                            <label class="flex items-center p-4  border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="radio" name="payment_method" value="qris" class="mr-2" data-fee="{{ 57000 * 0.007 }}" data-name="QRIS">
                                <img src="{{ url('/') }}/assets/pembayaran/qris.svg" alt="QRIS"
                                    class="h-6 mr-2">
                                QRIS
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 grow sm:mt-8 lg:mt-0">
                <div
                    class="space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800">
                    <div class="space-y-2">
                        <dl class="flex items-center justify-between gap-4">
                            <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Harga</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">Rp 57.000</dd>
                        </dl>

                        <dl class="flex items-center justify-between gap-4">
                            <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Biaya Transaksi</dt>
                            <dd id="transaction-fee" class="text-base font-medium text-gray-500">Rp 399</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4">
                            <dt class="text-sm font-normal italic text-gray-800 dark:text-gray-400">- <text id="metode-pembayaran"></text></dt>
                        </dl>
                    </div>

                    <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                        <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                        <dd id="total-cost" class="text-base font-bold text-gray-900 dark:text-white">Rp 57.499</dd>
                    </dl>
                </div>
            </div>
            <x-splade-script>
                document.addEventListener("DOMContentLoaded", function() {
                    document.querySelectorAll('input[name="payment_method"]').forEach((elem) => {
                        elem.addEventListener("change", function(event) {
                            var fee = event.target.getAttribute('data-fee');
                            var name = event.target.getAttribute('data-name');
                            var total = 57000 + parseInt(fee);
                            document.getElementById('transaction-fee').innerText = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(fee);
                            document.getElementById('total-cost').innerText = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(total);
                            document.getElementById('metode-pembayaran').innerText = name;
                        });
                    });
                });
            </x-splade-script>

            <div class="flex items-center justify-center">
                <x-splade-submit class="bg-primary-700 text-white" :label="__('Proses Pemesanan')" />
            </div>
            <div class="flex items-center justify-end py-10">
                <Link class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Login') }}
                </Link>
            </div>
        </x-splade-form>
    </x-auth-card>
@endsection
