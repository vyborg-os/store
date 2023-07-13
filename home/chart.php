<?php 
include_once('../model/controller.php');
    $table = 'pointsale';
    //$rt = fetchdata_all($table);
                //$created_at = substr($content,0,7);
                $created_at_year = date("Y");
                $total = char_tbl_($table,$created_at_year);
                //$spec = char_tbl($table,$created_at);
                $ja = '01';
                $fb = '02';
                $mr = '03';
                $ap = '04';
                $ma = '05';
                $ju = '06';
                $jl = '07';
                $au = '08';
                $se = '09';
                $oc = '10';
                $no = '11';
                $dc = '12';
                $jan = round(char_tbl($table,$ja,$created_at_year)/$total * 100,1);
                $feb = round(char_tbl($table,$fb,$created_at_year)/$total * 100,1);
                $mar = round(char_tbl($table,$mr,$created_at_year)/$total * 100,1);
                $apr = round(char_tbl($table,$ap,$created_at_year)/$total * 100,1);
                $may = round(char_tbl($table,$ma,$created_at_year)/$total * 100,1);
                $jun = round(char_tbl($table,$ju,$created_at_year)/$total * 100,1);
                $jul = round(char_tbl($table,$jl,$created_at_year)/$total * 100,1);
                $aug = round(char_tbl($table,$au,$created_at_year)/$total * 100,1);
                $sep = round(char_tbl($table,$se,$created_at_year)/$total * 100,1);
                $oct = round(char_tbl($table,$oc,$created_at_year)/$total * 100,1);
                $nov = round(char_tbl($table,$no,$created_at_year)/$total * 100,1);
                $dec = round(char_tbl($table,$dc,$created_at_year)/$total * 100,1);
                $data = array($jan,$feb,$mar,$apr,$may,$jun,$jul,$aug,$sep,$oct,$nov,$dec);
                //print_r($data);
                echo json_encode($data);
                //echo implode(",",$data);

   ?>