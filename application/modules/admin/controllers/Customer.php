<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends Admin_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->library(array('session', 'form_validation', 'pagination', 'mylibrary'));
        $this->load->model('common_model');
        $this->load->model('Customer_model', 'model');
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
        $config['base_url'] = base_url() . 'customer/loadData/';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = 10;

        // Initialize
        $this->pagination->initialize($config);

        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();
        $data['row'] = 0;

        $this->load_view('customer/view_customer', $data);
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
        $config['base_url'] = base_url() . 'customers/loadData/';
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
    public function add_customer()
    {
        $this->load_view('customer/add_customer');
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
            redirect('admin/customer/add_customer');
        } elseif ($check_mobile == false) {
            $this->session->set_flashdata('Invalid', UNIQUE_MOBILE);
            redirect('admin/customer/add_customer');
        }
        //  elseif ($check_landline == false) {
        //     $this->session->set_flashdata('Invalid', UNIQUE_MOBILE);
        //     redirect('admin/customer/add_customer');
        // } 
        else {
            // validation not ok, send validation errors to the view
            // Set flash data 
            $this->model->addRecord();
            $this->session->set_flashdata('Invalid', "New Customer Creation is Success");
            redirect('admin/customer');
        }
    }

    /*------------------ edit view record ----------------------*/
    public function editCustomer($customerId)
    {
        $customerId = base64_decode($customerId);
        //echo $customerId; exit();
        $data['data'] = $this->model->getIdByData($customerId);
        //print_r($data);
        //die;
        $this->load_view('customer/edit_customer', $data);
    }

    /*------------------ edit record in DB ----------------------*/
    public function update_customer($id)
    {
        if (isset($_POST['submit'])) {
            $this->model->updateRecord($id);
            $this->session->set_flashdata('Invalid', "Updated Successfully !");
            redirect('admin/customer');
        } else {
            redirect('admin/customer');
        }
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
        $venodrInfo = $this->model->getExportcustomers();
        //echo "<pre>"; print_r($venodrInfo); exit();
        if (!is_dir('uploads/export_customer')) {
            mkdir('uploads/export_customer', 0777, TRUE);
        }
        // create file name
        $fileName = 'customer-' . time() . '.xlsx';
        $save_file = 'uploads/export_customer/' . $fileName;
        // load excel library
        $this->load->library('excel');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'First Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Lastname');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Mobile No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Landline No');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'State');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'City');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Created Date');
        // set Row
        $rowCount = 2;
        $sr_no = 1;
        foreach ($venodrInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $sr_no++);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['fname']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['lname']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['var_mobile_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['var_alt_mobile']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['var_email']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['address']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['var_state']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element['var_city']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element['dt_createddate']);
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
        $data = $this->model->getExportcustomers();

        $custom_layout = array(300, 300);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 018', PDF_HEADER_STRING);
        $pdf->SetFont('helvetica', 'B', 15);
        $pdf->setPrintHeader(false);

        $pdf->setPrintFooter(false);

        $pdf->AddPage('P', $custom_layout);

        $subject = 'customers';

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
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>First Name</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Last Name</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Mobile No.</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Landline No.</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Email</b></td>
                   <td style="width:18%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Address</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>State</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>City</b></td>
                   <td style="width:10%;font-size:10px;text-align:center;border:1px solid #bdbdbd;"><b>Created Date</b></td>
                </tr>';
        $i = 1;
        foreach ($data as $key => $value) {


            $html .= '<tr>
                   <td style="width:2%;font-size:10px;text-align:center;border-right:1px solid #bdbdbd;">' . $i++ . '</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "> ' . $value['fname'] . '</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "> ' . $value['lname'] . '</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; "> ' . $value['var_mobile_no'] . '</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd;">' . $value['var_alt_mobile'] . '</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">' . $value['var_email'] . '</td>
                   <td style="width:18%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">' . $value['address'] . '</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">' . $value['var_state'] . '</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">' . $value['var_city'] . '</td>
                   <td style="width:10%;font-size:10px;text-align:center; border-right:1px solid #bdbdbd; ">' . $value['dt_createddate'] . '</td>
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

        $pdf_name = time() . 'customer';

        if (!is_dir('uploads/export_customer')) {
            mkdir('uploads/export_customer', 0777, TRUE);
        }

        $pdf_path = base_url() . 'uploads/export_customer/';
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
