<?php

class Football extends HY_Controller
{
    public $viewFolder = "";

    public function __construct()
    {

        parent::__construct();

        $this->viewFolder = "football_v";

        $this->load->model("football_model");
        $this->load->model("football_category_model");

        if(!get_active_user()){
            redirect(base_url("login"));
        }

    }

    public function index(){

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $items = $this->football_model->get_all(
            array(), "rank ASC"
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function category($id=""){

        $viewData = new stdClass();

        if (!is_numeric($id)){

            $alert = array(
                "title" => "İşlem Başarısız",
                "text" => "Yanlış bir konumdasınız, Lütfen tekrar deneyiniz",
                "type" => "error"
            );

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("football"));
            die();

        }

        /** Tablodan Verilerin Getirilmesi.. */
        $items = $this->football_model->get_all(
            array(
                "category_id" => $id
            ), "rank ASC"
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_form(){
        $viewData = new stdClass();

        $viewData->categories = $this->football_category_model->get_all(
            array(
                "isActive" => 1
            )
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function save(){

        $this->load->library("form_validation");

        // Kurallar yazilir..

        if($_FILES["img_url"]["name"] == ""){

            $alert = array(
                "title" => "İşlem Başarısız",
                "text" => "Lütfen bir görsel seçiniz",
                "type"  => "error"
            );

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("football/new_form"));

            die();
        }

        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("city", "Dogum Yeri", "required|trim");
        $this->form_validation->set_rules("category_id", "Kategori", "required|trim");
        $this->form_validation->set_rules("size", "Boy", "required|trim");
        $this->form_validation->set_rules("weight", "Kilo", "required|trim");
        $this->form_validation->set_rules("event_date", "Dogum Tarihi", "required|trim");
//        $this->form_validation->set_rules("facebook", "facebook", "required|trim");
//        $this->form_validation->set_rules("twitter", "twitter", "required|trim");
//        $this->form_validation->set_rules("youtube", "youtube", "required|trim");
//        $this->form_validation->set_rules("instagram", "instagram", "required|trim");


        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır"
            )
        );

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if($validate){

            // Upload Süreci...

            $file_name = convertToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

            $image_312x370 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder",312,370, $file_name);
            $image_476x574 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder",476,574, $file_name);

            if($image_312x370 && $image_476x574){

                $insert = $this->football_model->add(
                    array(
                        "title"         => $this->input->post("title"),
                        "url"           => convertToSEO($this->input->post("title")),
                        "city"          => $this->input->post("city"),
                        "mevki"         => $this->input->post("mevki"),
                        "category_id"   => $this->input->post("category_id"),
                        "size"          => $this->input->post("size"),
                        "weight"        => $this->input->post("weight"),
                        "facebook"      => $this->input->post("facebook"),
                        "twitter"       => $this->input->post("twitter"),
                        "instagram"     => $this->input->post("instagram"),
                        "youtube"       => $this->input->post("youtube"),
                        "event_date"    => $this->input->post("event_date"),
                        "img_url"       => $file_name,
                        "rank"          => 0,
                        "isActive"      => 1,
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

                redirect(base_url("football/new_form"));

                die();

            }

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("football"));

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
        $item = $this->football_model->get(
            array(
                "id"    => $id,
            )
        );

        $viewData->categories = $this->football_category_model->get_all(
            array(
                "isActive" => 1
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

        $this->form_validation->set_rules("title", "Başlık", "required|trim");
        $this->form_validation->set_rules("city", "Dogum Yeri", "required|trim");
        $this->form_validation->set_rules("category_id", "Kategori", "required|trim");
        $this->form_validation->set_rules("size", "Boy", "required|trim");
        $this->form_validation->set_rules("weight", "Kilo", "required|trim");
        $this->form_validation->set_rules("event_date", "Dogum Tarihi", "required|trim");
//        $this->form_validation->set_rules("facebook", "facebook", "required|trim");
//        $this->form_validation->set_rules("twitter", "twitter", "required|trim");
//        $this->form_validation->set_rules("youtube", "youtube", "required|trim");
//        $this->form_validation->set_rules("instagram", "instagram", "required|trim");

        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır"
            )
        );

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if($validate){

            // Upload Süreci...
            if($_FILES["img_url"]["name"] !== "") {

                $file_name = convertToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

                $image_312x370 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder",312,370, $file_name);
                $image_476x574 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder",476,574, $file_name);

                if($image_312x370 && $image_476x574){
                    delete_picture("football_model", $id, "312x370");
                    delete_picture("football_model", $id, "476x574");

                    $data = array(
                        "title"         => $this->input->post("title"),
                        "url"           => convertToSEO($this->input->post("title")),
                        "city"          => $this->input->post("city"),
                        "mevki"         => $this->input->post("mevki"),
                        "category_id"   => $this->input->post("category_id"),
                        "size"          => $this->input->post("size"),
                        "weight"        => $this->input->post("weight"),
                        "facebook"      => $this->input->post("facebook"),
                        "twitter"       => $this->input->post("twitter"),
                        "instagram"     => $this->input->post("instagram"),
                        "youtube"       => $this->input->post("youtube"),
                        "event_date"    => $this->input->post("event_date"),
                        "img_url"       => $file_name,
                        "rank"          => 0,
                        "isActive"      => 1,
                        "createdAt"     => date("Y-m-d H:i:s")
                    );

                } else {

                    $alert = array(
                        "title" => "İşlem Başarısız",
                        "text" => "Görsel yüklenirken bir problem oluştu",
                        "type" => "error"
                    );

                    $this->session->set_flashdata("alert", $alert);

                    redirect(base_url("football/update_form/$id"));

                    die();

                }

            } else {

                $data = array(
                    "title"         => $this->input->post("title"),
                    "url"           => convertToSEO($this->input->post("title")),
                    "city"          => $this->input->post("city"),
                    "mevki"         => $this->input->post("mevki"),
                    "category_id"   => $this->input->post("category_id"),
                    "size"          => $this->input->post("size"),
                    "weight"        => $this->input->post("weight"),
                    "facebook"      => $this->input->post("facebook"),
                    "twitter"       => $this->input->post("twitter"),
                    "instagram"     => $this->input->post("instagram"),
                    "youtube"       => $this->input->post("youtube"),
                    "event_date"    => $this->input->post("event_date"),
                    "rank"          => 0,
                    "isActive"      => 1,
                    "createdAt"     => date("Y-m-d H:i:s")
                );

            }

            $update = $this->football_model->update(array("id" => $id), $data);

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

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("football"));

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;

            /** Tablodan Verilerin Getirilmesi.. */
            $viewData->item = $this->football_model->get(
                array(
                    "id"    => $id,
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function delete($id){
        delete_picture("football_model", $id, "312x370");
        delete_picture("football_model", $id, "476x574");

        $delete = $this->football_model->delete(
            array(
                "id"    => $id
            )
        );

        // TODO Alert Sistemi Eklenecek...
        if($delete){

            $alert = array(
                "title" => "İşlem Başarılı",
                "text" => "Kayıt başarılı bir şekilde silindi",
                "type"  => "success"
            );

        } else {

            $alert = array(
                "title" => "İşlem Başarılı",
                "text" => "Kayıt silme sırasında bir problem oluştu",
                "type"  => "error"
            );


        }

        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("football"));


    }

    public function isActiveSetter($id){

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->football_model->update(
                array(
                    "id"    => $id
                ),
                array(
                    "isActive"  => $isActive
                )
            );
        }
    }

    public function rankSetter(){


        $data = $this->input->post("data");

        parse_str($data, $order);

        $items = $order["ord"];

        foreach ($items as $rank => $id){

            $this->football_model->update(
                array(
                    "id"        => $id,
                    "rank !="   => $rank
                ),
                array(
                    "rank"      => $rank
                )
            );

        }

    }

}
