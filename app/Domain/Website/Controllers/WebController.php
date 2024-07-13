<?php

namespace App\Domain\Website\Controllers;

use App\Http\Controllers\Controller;
use ProtoneMedia\Splade\Facades\SEO;

class WebController extends Controller
{
    public $description, $keywords, $sitename, $domain;
    public function __construct()
    {
        $this->description = 'Belajar Bisnis Digital Bersama Kelas entrepreneurID';
        $this->keywords = 'Belajar Bisnis, Agen entrepreneurID, entrepreneurID, Kelas entrepreneurID, Kelas eID';
        $this->sitename = 'Kelas entrepreneurID';
        $this->domain = 'kelasentrepreneurid.com';
    }
    public function home()
    {
        $page_title = 'Kelas entrepreneurID ';
        SEO::title($page_title)
            ->description($this->description)
            ->keywords($this->keywords)
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl($this->domain)
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;

        return view('website.pages.home');
    }

    public function kelas()
    {
        $page_title = 'Kelas entrepreneurID';
        SEO::title($page_title)
            ->description($this->description)
            ->keywords($this->keywords)
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl($this->domain)
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;

        return view('website.pages.kelas');
    }
    public function kontak()
    {
        $page_title = 'Kontak Kelas entrepreneurID';
        SEO::title($page_title)
            ->description($this->description)
            ->keywords($this->keywords)
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl($this->domain)
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;

        return view('website.pages.kontak');
    }

    public function informasi()
    {
        $page_title = 'Informasi Kelas entrepreneurID';
        SEO::title($page_title)
            ->description($this->description)
            ->keywords($this->keywords)
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl($this->domain)
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;

        return view('website.pages.informasi.index');
    }

    public function informasi_slug($slug)
    {
        $page_title = 'Informasi Kelas entrepreneurID';
        SEO::title($page_title)
            ->description($this->description)
            ->keywords($this->keywords)
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl($this->domain)
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;

        return view('website.pages.informasi.konten');
    }

    public function informasi_tag_slug($slug)
    {
        $page_title = $slug;
        SEO::title($page_title)
            ->description($this->description)
            ->keywords($this->keywords)
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl($this->domain)
            ->openGraphImage(asset('/assets/img/logo-arrahmah.png'))
            ;

        return view('website.pages.informasi.tag');
    }
}
