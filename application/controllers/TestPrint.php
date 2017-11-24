<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestPrint extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}


	public function Test_print()
	{
		// $text = 'Printkan Dulu Ini';     
		// /* tulis dan buka koneksi ke printer */    
		// $printer = printer_open("EPSON-TM-U220");

		// printer_set_option($printer, PRINTER_MODE, "RAW")  
		// /* write the text to the print job */  
		// printer_write($printer, $text);   
		// /* close the connection */ 
		// printer_close($printer);

		$handle= printer_open("EPSON-TM-U220");
		printer_set_option($handle, PRINTER_MODE, "RAW"); 
		printer_start_doc($handle, "Tes Printer"); 
		printer_start_page($handle); 
		printer_write($handle , "Nama Barang \n\r "); 
		printer_write($handle , "Rinso : 2x 1500  =  3000 \n\r"); 
		printer_end_page($handle); 
		printer_end_doc($handle); 
		printer_close($handle);
	}
}
