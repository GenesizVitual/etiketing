<?php if(! defined('BASEPATH')) exit ('no direct access allowed');
 
class Database extends CI_controller{

    public  function backupdb(){
        // Load Clas Utilitas Database
                $this->load->dbutil();

                // nyiapin aturan untuk file backup
                $aturan = array(
                        'tables'      =>array('klien','registrasi_kartu','total_deposit','deposit','beli_tiket','rute','jenis_kapal','jenis_retribusi','jenis_tarif','kabupaten','pelabuhan','user'),// sengaja supaya terurut dari yang paling penting
                        //'ignore'      => array(),
                        'format'      => 'zip',
                        'filename'    => 'mySql.sql',
                        //'add_drop'    => TRUE,
                        //'add_insert'  => TRUE,
                        //'newline'     => "\n"
                );


                $backup =& $this->dbutil->backup($aturan);

                $nama_database = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
                $simpan = 'backup/files/database-'.$nama_database;

                $this->load->helper('file');
                write_file($simpan, $backup);

                $this->load->helper('download');
                force_download($nama_database, $backup);
                $status['status']=true;
                echo json_encode($status);
        }

        function restoredb()
        {
           $this->load->library('zip');
             //upload dulu filenya
            $zip = new ZipArchive;
            $fupload = $this->input->post('nameFiles');
            $direktori='./backup/files/'.$fupload ;
            if ($zip->open($direktori) === TRUE) {
                for ($i = 0; $i < $zip->numFiles; $i++) {
                   // echo $zip->getNameIndex($i);
                    if(!is_dir($zip->getNameIndex($i))) {
                     //   echo "-------------".$zip->getFromIndex($i);
                        $isi_file=$zip->getFromIndex($i);
                        $string_query=rtrim($isi_file, "\n;" );
                        $array_query=explode(";", $string_query);
                        foreach($array_query as $query){
                            $this->db->query("SET FOREIGN_KEY_CHECKS = 0");
                            $this->db->query($query);
                            $this->db->query("SET FOREIGN_KEY_CHECKS = 1");
                        }
                    } else {
                        echo '<br/>';
                    }
                }
                $status['status'] = true;
            }

          //  $status['status'] = true;
            echo json_encode($direktori);
        }
       
}