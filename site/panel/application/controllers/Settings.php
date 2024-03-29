<?php

class Settings extends HY_Controller
{
    public $viewFolder = "";

    public function __construct()
    {

        parent::__construct();

        $this->viewFolder = "settings_v";

        $this->load->model("settings_model");

        if(!get_active_user()){
            redirect(base_url("login"));
        }

    }

    public function index(){

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $item = $this->settings_model->get();

        if($item)
            $viewData->subViewFolder = "update";
        else
            $viewData->subViewFolder = "no_content";

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_form(){

        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function save(){


        $this->load->library("form_validation");

        // Kurallar yazilir..

        if($_FILES["logo"]["name"] == ""){

            $alert = array(
                "title" => "İşlem Başarısız",
                "text" => "Masaüstü Logo için lütfen bir görsel seçiniz",
                "type"  => "error"
            );

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("settings/new_form"));

            die();
        }

        if($_FILES["mobile_logo"]["name"] == ""){

            $alert = array(
                "title" => "İşlem Başarısız",
                "text" => "Mobil Logo için lütfen bir görsel seçiniz",
                "type"  => "error"
            );

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("settings/new_form"));

            die();
        }

        if($_FILES["favicon"]["name"] == ""){

            $alert = array(
                "title" => "İşlem Başarısız",
                "text" => "Favicon için lütfen bir görsel seçiniz",
                "type"  => "error"
            );

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("settings/new_form"));

            die();
        }

        $this->form_validation->set_rules("company_name", "Şirket Adı", "required|trim");
        $this->form_validation->set_rules("phone_1", "Telefon 1", "required|trim");
        $this->form_validation->set_rules("email", "E-posta Adresi", "required|trim|valid_email");

        $this->form_validation->set_message(
            array(
                "required"     => "<b>{field}</b> alanı doldurulmalıdır",
                "valid_email"  => "Lütfen geçerli bir <b>{field}</b> giriniz"
            )
        );

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if($validate){

            // Upload Süreci...

            $file_name = convertToSEO($this->input->post("company_name")) . "." . pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);

            $image_200x75 = upload_picture($_FILES["logo"]["tmp_name"], "uploads/$this->viewFolder",200,75, $file_name);
            $image_200x74 = upload_picture($_FILES["mobile_logo"]["tmp_name"], "uploads/$this->viewFolder",200,74, $file_name);
            $image_32x32  = upload_picture($_FILES["favicon"]["tmp_name"], "uploads/$this->viewFolder",32,32, $file_name);

            if($image_200x75 && $image_200x74 && $image_32x32){

                $insert = $this->settings_model->add(
                    array(
                        "company_name"  => $this->input->post("company_name"),
                        "phone_1"       => $this->input->post("phone_1"),
                        "phone_2"       => $this->input->post("phone_2"),
                        "fax_1"         => $this->input->post("fax_1"),
                        "fax_2"         => $this->input->post("fax_2"),
                        "address"       => $this->input->post("address"),
                        "about_us"      => $this->input->post("about_us"),
                        "mission"       => $this->input->post("mission"),
                        "vision"        => $this->input->post("vision"),
                        "email"         => $this->input->post("email"),
                        "facebook"      => $this->input->post("facebook"),
                        "twitter"       => $this->input->post("twitter"),
                        "instagram"     => $this->input->post("instagram"),
                        "linkedin"      => $this->input->post("linkedin"),
                        "logo"          => $file_name,
                        "mobile_logo"   => $file_name,
                        "favicon"       => $file_name,
                        "createdAt"     => date("Y-m-d H:i:s")
                    )
                );

                // TODO Alert sistemi eklenecek...
                if($insert){

                    $alert = array(
                        "title" => "İşlem Başarılı",
                        "text" => "Kayıt başarılı bir şekilde eklendi",
                        "type"  => "success"
                    );

                } else {

                    $alert = array(
                        "title" => "İşlem Başarısız",
                        "text" => "Kayıt Ekleme sırasında bir problem oluştu",
                        "type"  => "error"
                    );
                }

            } else {

                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text" => "Görsel yüklenirken bir problem oluştu",
                    "type"  => "error"
                );

                $this->session->set_flashdata("alert", $alert);

                redirect(base_url("settings/new_form"));

                die();

            }

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("settings"));

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function update_form($id){

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $item = $this->settings_model->get(
            array(
                "id"    => $id,
            )
        );
        
        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);


    }

    public function update($id){

        $this->load->library("form_validation");

        // Kurallar yazilir..

        $this->form_validation->set_rules("company_name", "Şirket Adı", "required|trim");
        $this->form_validation->set_rules("phone_1", "Telefon 1", "required|trim");
        $this->form_validation->set_rules("email", "E-posta Adresi", "required|trim|valid_email");

        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır",
                "valid_email"  => "Lütfen geçerli bir <b>{field}</b> giriniz"
            )
        );

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if($validate){


            $data = array(
                "company_name"  => $this->input->post("company_name"),
                "phone_1"       => $this->input->post("phone_1"),
                "phone_2"       => $this->input->post("phone_2"),
                "fax_1"         => $this->input->post("fax_1"),
                "fax_2"         => $this->input->post("fax_2"),
                "address"       => $this->input->post("address"),
                "about_us"      => $this->input->post("about_us"),
                "mission"       => $this->input->post("mission"),
                "vision"        => $this->input->post("vision"),
                "email"         => $this->input->post("email"),
                "facebook"      => $this->input->post("facebook"),
                "twitter"       => $this->input->post("twitter"),
                "instagram"     => $this->input->post("instagram"),
                "linkedin"      => $this->input->post("linkedin"),
                "updatedAt"     => date("Y-m-d H:i:s")
            );

            // Masaüstü Logosu için Upload Süreci...
            if($_FILES["logo"]["name"] !== "") {

                $fileName = $this->settings_model->get(
                    array(
                        "id"    => $id
                    )
                );
                unlink("uploads/settings_v/200x75/{$fileName->logo}");

                $file_name = convertToSEO($this->input->post("company_name")) . "." . pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);

                $image_200x75 = upload_picture($_FILES["logo"]["tmp_name"], "uploads/$this->viewFolder",200,75, $file_name);

                if($image_200x75){


                    $data["logo"] = $file_name;

                } else {

                    $alert = array(
                        "title" => "İşlem Başarısız",
                        "text"  => "Masaüstü görseli yüklenirken bir problem oluştu",
                        "type"  => "error"
                    );

                    $this->session->set_flashdata("alert", $alert);

                    redirect(base_url("settings/update_form/$id"));

                    die();

                }

            }

            // Mobil Logosu için Upload Süreci...
            if($_FILES["mobile_logo"]["name"] !== "") {
                $fileName = $this->settings_model->get(
                    array(
                        "id"    => $id
                    )
                );
                unlink("uploads/settings_v/200x74/{$fileName->mobile_logo}");


                $file_name = convertToSEO($this->input->post("company_name")) . "." . pathinfo($_FILES["mobile_logo"]["name"], PATHINFO_EXTENSION);

                $image_200x74 = upload_picture($_FILES["mobile_logo"]["tmp_name"], "uploads/$this->viewFolder",200,74, $file_name);

                if($image_200x74){

                    $data["mobile_logo"] = $file_name;

                } else {

                    $alert = array(
                        "title" => "İşlem Başarısız",
                        "text"  => "Mobil görseli yüklenirken bir problem oluştu",
                        "type"  => "error"
                    );

                    $this->session->set_flashdata("alert", $alert);

                    redirect(base_url("settings/update_form/$id"));

                    die();

                }

            }

            // Favicon için Upload Süreci...
            if($_FILES["favicon"]["name"] !== "") {
                $fileName = $this->settings_model->get(
                    array(
                        "id"    => $id
                    )
                );
                unlink("uploads/settings_v/32x32/{$fileName->favicon}");

                $file_name = convertToSEO($this->input->post("company_name")) . "." . pathinfo($_FILES["favicon"]["name"], PATHINFO_EXTENSION);

                $image_32x32 = upload_picture($_FILES["favicon"]["tmp_name"], "uploads/$this->viewFolder",32,32, $file_name);

                if($image_32x32){

                    $data["favicon"] = $file_name;

                } else {

                    $alert = array(
                        "title" => "İşlem Başarısız",
                        "text"  => "Favicon görseli yüklenirken bir problem oluştu",
                        "type"  => "error"
                    );

                    $this->session->set_flashdata("alert", $alert);

                    redirect(base_url("settings/update_form/$id"));

                    die();

                }

            }


            $update = $this->settings_model->update(array("id" => $id), $data);

            // TODO Alert sistemi eklenecek...
            if($update){

                $alert = array(
                    "title" => "İşlem Başarılı",
                    "text" => "Kayıt başarılı bir şekilde güncellendi",
                    "type"  => "success"
                );

            } else {

                $alert = array(
                    "title" => "İşlem Başarısız",
                    "text" => "Kayıt Güncelleme sırasında bir problem oluştu",
                    "type"  => "error"
                );
            }


            // Session Update İşlemi

            $settings = $this->settings_model->get();
            $this->session->set_userdata("settings", $settings);

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("settings"));

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;

            /** Tablodan Verilerin Getirilmesi.. */
            $viewData->item = $this->settings_model->get(
                array(
                    "id"    => $id,
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }


}
