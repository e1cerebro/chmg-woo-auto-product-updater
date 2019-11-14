<?php

    class ChmgWapuEmail{

        public function send_sync_complete_mail($data = [], $cron_job = false){

            $headers = array('Content-Type: text/html; charset=UTF-8');
            if(sizeof($data) > 0){
                $message = "<p>The following product(s) could not be updated:</p>\n";
                $message .= "<hr/><ol>";

                foreach($data as $product){
                    $message .= "\n <li>".$product."</li>";
                }
                $message .= "</ol>";
                $message .= "<p> Doamin: ".self::domain_host()."</p>";

                $sheetID = get_option('chmg_wapu_sheet_id_el');
                $message .= "<p>Sheet: https://docs.google.com/spreadsheets/d/".$sheetID."/edit</p>";

            }else{
                $message = "<p>Sheet successfully synced with your website</p>\n";
                $message .= "<p>Domain: ".self::domain_host()."</p>";

                $sheetID = get_option('chmg_wapu_sheet_id_el');
                
                $message .= "<p>Sheet: https://docs.google.com/spreadsheets/d/".$sheetID."/edit</p>";
            }
            $recipient_email = self::get_recipients();

            $mail_title = false == $cron_job ? "Woo Sync Report" : "Cron Job Sync Report";

            wp_mail( $recipient_email , $mail_title , $message, $headers);
            
        }

        public function send_error_mail($message = ''){
            $headers = array('Content-Type: text/html; charset=UTF-8');

            $recipient_email = self::get_recipients();
            $message .= "<p>Domain: ".self::domain_host()."</p>";
            wp_mail( $recipient_email , "Woo Sync Error Report", $message, $headers);
        }

        private function get_recipients(){
            $chmg_wapu_mail_filter      = get_option('chmg_wapu_email_who_el');
            $chmg_wapu_mail_recipient   = get_option('chmg_wapu_mail_recipient_el');
            $recipient = '';

            switch ($chmg_wapu_mail_filter) {
                case 'admin_only':
                    # code...
                    $recipient = CHMG_WAPU_ADMIN_EMAIL;
                    break;
                
                case 'others_only':
                    # code...
                    $recipient = $chmg_wapu_mail_recipient;
                    break;
                
                case 'admin_and_others':
                    # code...
                    $recipient = [ CHMG_WAPU_ADMIN_EMAIL, $chmg_wapu_mail_recipient];
                    break;
                
                default:
                    # code...
                    break;
            }


            return $recipient;
        }

        private function domain_host(){
           
            $domain_name = !empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] :  $_SERVER['SERVER_NAME '];
          
            return " https://".$domain_name;
        }



    }