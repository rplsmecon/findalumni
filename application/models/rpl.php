<?php
/**
 * RPL V.1.0
 *
 * @author		Raka Aditya <raka@gedrix.com>
 * @copyright	Copyright (c) 2014 Gedrix Creative (gedrix.com)
 * @link		http://gedrix.com
 * @version		1.0.0
 *
 * Model ini digunakan untuk konfigurasi
 * yang bersifat umum dan digunakan di
 * semua controller
 */

class rpl extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	function tanggalLDMYHIS($date) {
		$tgl        = date_create($date);
		$nama_bulan	= array(01=>"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $hari       = date_format($tgl, "l");
        $tanggal    = date_format($tgl,"d");
        $bulan      = $nama_bulan[date_format($tgl,"m")];
        $tahun      = date_format($tgl,"Y");
        $jam        = date_format($tgl,"H:i:s");
        switch($hari) {		
		case "Monday" : {
					$hari='Senin';
				}break;
		case "Tuesday" : {
					$hari='Selasa';
				}break;
		case "Wednesday" : {
					$hari='Rabu';
				}break;
		case "Thursday" : {
					$hari='Kamis';
				}break;
		case "Friday" : {
					$hari='Jumat';
				}break;
		case "Saturday" : {
					$hari="Sabtu";
				}break;
		case "Sunday" : {
					$hari='Minggu';
				}break;
		default: {
					$bulan_ini='<font color=red>Bulan Error</font>';
				}break;
	}
        $tanggalnya = $hari.', '.$tanggal.' '.$bulan.' '.$tahun.' '.$jam.' WIB';
        return $tanggalnya;
	}
}