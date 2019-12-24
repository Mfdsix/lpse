<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use App\Link;
use App\Packet;

class ScrapController extends Controller
{
	public function index(){
		$links = Link::all();
		return view('welcome', compact('links'));
	}

	public function scrap(Request $request){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://127.0.0.1:5000/");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'url='.$request->link);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		curl_close ($ch);
		$datas = json_decode($server_output, true);
		session(['datas'=>$datas]);
		$return = "";
		foreach ($datas as $key => $value) {
			$return .= "<tr>";
			$return .= "<td>".$value['code']."</td>";
			$return .= "<td>".$value['name']."</td>";
			$return .= "<td>".$value['price']."</td>";
			$return .= "<td>".$value['registration']."</td>";
			$return .= "</tr>";
		}

		echo $return;
	}

	public function import(){
		echo "Sedang Proses...<br>";
		$datas = session()->get('datas');
		if(empty($datas)){
			echo "Datanya belum ada nih, coba lagi ya...";
		}else{
			echo "Ntar, ane cek dulu...<br>";
			$packet = Packet::where('source', $datas[0]['source'])->count();
			if($packet > 0){
				echo "Udah ada data sebelumnya nih, tunggu ya ! mau dihapus dulu...<br>";
				Packet::where('source', $datas[0]['source'])->delete();
			}
			echo "Sip deh, lanjuuttt...<br>";
			echo "Bismillah mulai mengimport...<br>";
			foreach ($datas as $key => $value) {
				Packet::create($value);
				echo $value['code']." Berhasil Masuk...<br>";
			}
			session()->forget('datas');
			echo "Alhamdulillah, semua data sudah masuk";
		}
	}
}
