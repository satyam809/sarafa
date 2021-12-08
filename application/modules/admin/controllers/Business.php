<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Business extends Admin_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->library(array('session', 'form_validation', 'pagination', 'mylibrary'));
        $this->load->model('common_model');
        $this->load->model('Business_model', 'model');
    }

    /*---------------------------- view data index -----------------------*/
    public function index()
    {

        $allcount = $this->model->records_count();

        $data['total_rows'] = $allcount;

        $query = $this->db->where('chr_delete', 'N')->get('mst_users');
        $data['total_data'] = $query->num_rows();

        $data['data'] = $this->model->getData(0, 10);

        // Pagination Configuration
        $config['base_url'] = base_url() . 'business/loadData/';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = 10;

        // Initialize
        $this->pagination->initialize($config);

        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['row'] = 0;

        $this->load_view('business/view_business', $data);
    }

    /*---------------------------- Load view data -----------------------*/
    public function loadData($rowno = 0)
    {

        $search = $_GET['append'];
        $_field = $_GET['field'];
        $_sort = $_GET['sort'];
        // Row per page
        $rowperpage = $_GET['entries'];

        // Row position
        if ($rowno != 0) {
            $rowno = ($rowno - 1) * $rowperpage;
        }

        // All records count
        $allcount = $this->model->records_count($search);

        $data['total_rows'] = $allcount;

        $query = $this->db->where('chr_delete', 'N')->get('mst_users');
        $data['total_data'] = $query->num_rows();
        // Get records
        $customers_record = $this->model->getData($rowno, $rowperpage, $search, $_field, $_sort);

        // Pagination Configuration
        $config['base_url'] = base_url() . 'business/loadData/';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowperpage;

        // Initialize
        $this->pagination->initialize($config);

        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['result'] = $customers_record;
        $data['row'] = $rowno;

        echo json_encode($data);
    }

    /*------------------ add view record ----------------------*/
    public function add_business()
    {
        $data = $this->model->fetch_business_category();
        $businessCat['business'] = $data->result();
        //echo "<pre>";print_r($businessCat);die;
        $this->load_view('business/add_business', $businessCat);
    }

    /*------------------ add record in DB ----------------------*/
    public function insert_record()
    {
        $mobile = $this->input->post('mobile');
        $landline = $this->input->post('landline');
        $email = $this->input->post('email');
        $customeremail = $this->model->checkEmail($email);
        $check_mobile = $this->model->checkMobile($mobile);
        //$check_landline = $this->model->checkLandline($landline);

        if ($customeremail == false) {
            $this->session->set_flashdata('Invalid', UNIQUE_EMAIL);
            //print_r($_SESSION);die;
            redirect('admin/business/add_business');
        } elseif ($check_mobile == false) {
            $this->session->set_flashdata('Invalid', UNIQUE_MOBILE);
            redirect('admin/business/add_business');
        }
        // elseif ($check_landline == false) {
        //     $this->session->set_flashdata('Invalid', UNIQUE_MOBILE);
        //     redirect('admin/business/add_business');
        // } 
        else {
            // validation not ok, send validation errors to the view
            // Set flash data 
            $this->model->addRecord();
            $this->session->set_flashdata('Invalid', "New Business Creation is Success");
            redirect('admin/business');
        }
    }

    /*------------------ edit view record ----------------------*/
    public function editBusiness($businessId)
    {
        $bussData = $this->model->fetch_business_category();
        $data['business'] = $bussData->result();
        $businessId = base64_decode($businessId);
        $data['data'] = $this->model->getIdByData($businessId);
        //echo "<pre>";print_r($data);die;
        $this->load_view('business/edit_business', $data);
    }

    /*------------------ edit record in DB ----------------------*/
    public function update_business($id)
    {
        if (isset($_POST['submit'])) {
            $this->model->updateRecord($id);
            $this->session->set_flashdata('Invalid', "Updated Successfully !");
            redirect('admin/business');
        } else {
            redirect('admin/business');
        }
    }

    /*------------------------ delete product multiple images --------------------*/
    public function deleteProductImges()
    {
        //echo "hello";die();
        $id = $_POST['id'];
        $del_image = $_POST['image'];
        $sql = "select p_images from mst_users where int_glcode='$id'";
        $result = $this->db->query($sql);
        $row = $result->result_array();
        $images = $row[0]['p_images'];
        $update_images = str_replace($del_image . ',', '', $images);

        $filePath = "uploads/userProduct/" . $del_image;
        if (unlink($filePath)) {
            $sql1 = "update mst_users set p_images='$update_images' where int_glcode='$id'";
            if ($this->db->query($sql1)) {
                echo "1";
            }
        }

        //echo $del_image;
        //print_r($row);
        die;

        //$this->db->where('int_glcode', $id);
        //$this->db->delete('trn_product_images');

        //return  $id = $this->db->affected_rows();
    }
    /*----------------------- update publish  ----------------------*/
    public function UpdatePublish()
    {
        $this->model->updatedisplay();
    }

    /*----------------------- delete multiple record  ----------------------*/
    public function delete_multiple()
    {
        //$this->model->delMultiplePlan();
        $result = $this->model->delete_multiple();
        echo $result;
    }

    /*----------------------- delete customer address ------------------------*/
    public function deleteAddress()
    {
        //echo "hello";die();
        $id = $_POST['id'];
        $this->db->set('chr_delete', 'Y');
        $this->db->where('int_glcode', $id);
        $this->db->update('mst_customer_address');

        return  $id = $this->db->affected_rows();
    }

    public function createXLSVendors()
    {
        $businessInfo = $this->model->getExportBusiness();
        // echo "<pre>";
        // print_r($businessInfo);
        // exit();
        if (!is_dir('uploads/export_business')) {
            mkdir('uploads/export_business', 0777, TRUE);
        }
        // create file name
        $fileName = 'business-' . time() . '.xlsx';
        $save_file = 'uploads/export_business/' . $fileName;
        // load excel library
        $this->load->library('excel');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Category');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'First Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Last Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Mobile No');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Landline No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'State');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'City');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Company');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Businessess');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Created Date');
        // set Row
        $rowCount = 2;
        $sr_no = 1;
        foreach ($businessInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $sr_no++);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['catAs']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['fname']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['lname']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['var_mobile_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['var_alt_mobile']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['var_email']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['address']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element['var_state']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element['var_city']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element['company']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $element['businessCat']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $element['dt_createddate']);
            $rowCount++;
        }

        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

            $objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet));

            $sheet = $objPHPExcel->getActiveSheet();
            $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(true);
            /** @var PHPExcel_Cell $cell */
            foreach ($cellIterator as $cell) {
                $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
            }
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($save_file);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(base_url() . $save_file);
    }

    public function pdf_viewer()
    {

        $this->load->library('Pdf');
        $data = $this->model->getExportBusiness();

        $custom_layout = array(300, 300);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 018', PDF_HEADER_STRING);
        $pdf->SetFont('helvetica', 'B', 15);
        $pdf->setPrintHeader(false);

        $pdf->setPrintFooter(false);

        $pdf->AddPage('P', $custom_layout);

        $subject = 'business';

        $pdf->SetFont('helvetica', 'n', 12);

        $ch = 0;

        $i = 1;

        $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html lang="en">
       <head>

          <title>Vendor Log History</title>
          <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
       </head>
       <body style=" position: relative;
          width:400px;
          height: 100%; 
          margin: 0 auto !important; 
          color: #001028;
          background: #FFFFFF; 
          font-size: 12px; 
          border: 1px solid #efefef;">

          <table style="border:1px solid #bdbdbd" width="100%" cellspacing="0" cellpadding="5">
             <tbody>
                <tr style="background-color:#EFEFEF;">
                   <td style="width:2%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>#</b></td>
                   <td style="width:5%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Category</b></td>
                   <td style="width:5%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>First Name</b></td>
                   <td style="width:5%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Last Name</b></td>
                   <td style="width:5%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Mobile No.</b></td>
                   <td style="width:5%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Landline No.</b></td>
                   <td style="width:5%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Email</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Address</b></td>
                   <td style="width:5%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>State</b></td>
                   <td style="width:5%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>City</b></td>
                   <td style="width:5%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Company</b></td>
                   <td style="width:38%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Business</b></td>
                   <td style="width:5%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Created Date</b></td>
                </tr>';
        $i = 1;
        foreach ($data as $key => $value) {


            $html .= '<tr>
                   <td style="width:2%;font-size:10px;text-align:center;border-right:1px solid #bdbdbd;">' . $i++ . '</td>
                   <td style="width:5%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "> ' . $value['catAs'] . '</td>
                   <td style="width:5%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "> ' . $value['fname'] . '</td>
                   <td style="width:5%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">' . $value['lname'] . '</td>
                   <td style="width:5%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "> ' . $value['var_mobile_no'] . '</td>
                   <td style="width:5%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd;">' . $value['var_alt_mobile'] . '</td>
                   <td style="width:5%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">' . $value['var_email'] . '</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">' . $value['address'] . '</td>
                   <td style="width:5%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">' . $value['var_state'] . '</td>
                   <td style="width:5%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">' . $value['var_city'] . '</td>
                   <td style="width:5%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">' . $value['company'] . '</td>
                   <td style="width:38%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">' . $value['businessCat'] . '</td>
                   <td style="width:5%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">' . $value['dt_createddate'] . '</td>
                </tr>';
        }

        $html .= '</tbody>
          </table>
       </body>
    </html>';

        //echo $html;exit;
        // set some language dependent data:
        $lg = array();
        $l['a_meta_charset'] = 'UTF-8';
        $l['a_meta_dir'] = 'ltr';
        $l['a_meta_language'] = 'hi';
        $lg['w_page'] = 'page';

        // set some language-dependent strings (optional)
        $pdf->setLanguageArray($lg);

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('freesans', '', 12);
        $pdf->writeHTML($html, true, false, false, false, '');

        $pdf_name = time() . 'business';

        if (!is_dir('uploads/export_business')) {
            mkdir('uploads/export_business', 0777, TRUE);
        }

        $pdf_path = base_url() . 'uploads/export_business/';
        $pdf->Output($pdf_name . '.pdf', 'D');
        $get_pdf = $pdf_path . $pdf_name . '.pdf';
        //echo $get_pdf;
        return "True";
    }

    function get_address()
    {

        $url = "http://www.postalpincode.in/api/pincode/" . $_POST["pincode"];
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, $url);
        curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

        $result = json_decode(curl_exec($curlSession));
        curl_close($curlSession);

        $city = $result->PostOffice[0]->District;
        $state = $result->PostOffice[0]->State;
        $country = $result->PostOffice[0]->Country;

        echo $city . '***' . $state . '***' . $country;
        exit;
    }
}
