<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Spatie\Sitemap\SitemapGenerator;

class SitemapController extends Controller
{
    public function index()
	{
		try{
			SitemapGenerator::create(config('app.url'))->writeToFile(public_path('sitemap.xml'));
		}
		catch(Exception $exp){
			echo $exp->getMessage();
			return;
		}
		echo "Sitemap created";
	}
}
