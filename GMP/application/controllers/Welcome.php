<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public $benchmark;
    public $hooks;
    public $config;
    public $log;
    public $utf8;
    public $uri;
    public $router;
    public $output;
    public $security;
    public $input;
    public $lang;
    public $email;
    public $session;
    public $Main_model;
    public $db;
    public $upload;

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function __construct() {
        parent::__construct();
        // Load the Main_model
        $this->load->model('Main_model');
        // $this->load->library('form_validation'); // Load the library
       
    }

	public function index()
	{
		$this->load->view('login');
	}

	public function authLogin() {
    // Load the form validation library
    $this->load->library('form_validation');

    // Set validation rules for email and password
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
        'required' => 'The Email field is required.',
        'valid_email' => 'Please enter a valid Email address.'
    ]);
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]', [
        'required' => 'The Password field is required.',
        'min_length' => 'The Password must be at least 6 characters long.'
    ]);

    if ($this->form_validation->run() == FALSE) {
        // Validation failed, send back to the login page with error messages
        $this->session->set_flashdata('failure_message_email', form_error('email'));
        $this->session->set_flashdata('failure_message_password', form_error('password'));
        redirect('login');
    } else {
        // Validation passed, proceed with authentication
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        
        $adminData = $this->db->get_where('login', array("email" => $email));
        if ($adminData->num_rows() > 0) {
            $userData = $adminData->row();
            if ($userData->password == $password) {
                $_SESSION['user_id'] = $this->input->post('email');
                $this->session->set_flashdata('success_message', 'Welcome, You Are Successfully Logged In.');
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('failure_message_password', 'Invalid password');
                $this->session->set_flashdata('failure_message_email', ''); // Reset email error message
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('failure_message_email', 'Invalid email');
            $this->session->set_flashdata('failure_message_password', ''); // Reset password error message
            redirect('login');
        }
    }
}

	public function A_logout_sessionDestroy() {
	    if (!$this->session->userdata('user_id')) redirect('login');
	    $this->session->sess_destroy();
	    redirect('login');
	}
//------------------------
	
	public function dashboard_page()
{
    if (!$this->session->userdata('user_id')) redirect('login');
    
    // Load the necessary views
    $this->load->view('header');

    // Fetch required data
    $getsales = $this->Main_model->get_sales_data(); // Ensure this method exists
    $total_payable_amount = $this->Main_model->get_total_payable_amount(); // Ensure this method exists
    $total_paid_amount = $this->Main_model->get_total_paid_amount(); // Ensure this method exists

    // Calculate the total balance dynamically
    $total_balance = ($total_payable_amount ?? 0) - ($total_paid_amount ?? 0);

    // Pass the data to the view
    $data['getsales'] = $getsales;
    $data['total_payable_amount'] = $total_payable_amount;
    $data['total_paid_amount'] = $total_paid_amount;
    $data['total_balance'] = $total_balance;

    $this->load->view('dashboard', $data);
    $this->load->view('footer');
}


//------------------
	public function customer_page()
	{
		if (!$this->session->userdata('user_id')) redirect('login');
		$this->load->view('header');
		$result['getCustomer'] = $this->Main_model->getAllCustomer();
		$this->load->view('registrations/customer', $result);
		$this->load->view('footer');
	}

	public function insertCustomer(){
		$this->Main_model->add_Custmoer();
		 redirect('customer-reg');
	}

	public function deleteCustomer(){
		$this->Main_model->disableCustomer();
		redirect('customer-reg');
	}

	public function updateCustomer() {
	    $this->Main_model->update_customer(); 
	    redirect('customer-reg');
	}
//--------------------
    public function supplier_page()
	{
		if (!$this->session->userdata('user_id')) redirect('login');
		$this->load->view('header');
		$result['getSupplier'] = $this->Main_model->getAllSupplier();
		$this->load->view('registrations/supplier', $result);
		$this->load->view('footer');
	}

	public function insertSupplier(){
		$this->Main_model->add_supplier();
		 redirect('supplier-reg');
	}

	public function deleteSupplier(){
		$this->Main_model->disableSupplier();
		redirect('supplier-reg');
	}

	public function updateSupplier() {
	    $this->Main_model->update_supplier(); 
	    redirect('supplier-reg');
	}
//-----------------------------
    public function labour_page()
	{
		if (!$this->session->userdata('user_id')) redirect('login');
		$this->load->view('header');
		$result['getLabour'] = $this->Main_model->getAllLabour();
		$this->load->view('registrations/labour', $result);
		$this->load->view('footer');
	}

	public function insertLabour(){
		$this->Main_model->add_labour();
		 redirect('labour-reg');
	}

	public function deleteLabour(){
		$this->Main_model->disableLabour();
		redirect('labour-reg');
	}

	public function updateLabour() {
	    $this->Main_model->update_labour(); 
	    redirect('labour-reg');
	}
//------------------------

	 public function units_page()
	{
		if (!$this->session->userdata('user_id')) redirect('login');
		$this->load->view('header');
		$result['getUnits'] = $this->Main_model->getAllUnits();
		$this->load->view('masters/units', $result);
		$this->load->view('footer');
	}
    
	public function insertUnits(){
		$this->Main_model->add_units();
		 redirect('units-master');
	}

	public function deleteUnits(){
		$this->Main_model->disableUnits();
		redirect('units-master');
	} 

	public function updateUnits() {
	    $this->Main_model->update_units(); 
	    redirect('units-master');
	}
//-----------------------------------

	public function raw_page()
	{
		if (!$this->session->userdata('user_id')) redirect('login');
		$this->load->view('header');
		$result['getRaw'] = $this->Main_model->getAllRaw();
		$result['getUnits'] = $this->Main_model->getAllUnits();
		$this->load->view('masters/raw_materials', $result);
		$this->load->view('footer');
	}

	public function insertRaw(){
		$this->Main_model->add_raw();
		 redirect('raw-master');
	}

	public function deleteRaw(){
		$this->Main_model->disableRaw();
		redirect('raw-master');
	} 

	public function updateRaw() {
	    $this->Main_model->update_raw(); 
	    redirect('raw-master');
	}
//---------------------------------
	 public function pieces_page()
	{
		if (!$this->session->userdata('user_id')) redirect('login');
		$this->load->view('header');
		$result['getPieces'] = $this->Main_model->getAllPieces();
		$this->load->view('masters/pieces_pp', $result);
		$this->load->view('footer');
	}

	public function insertPieces(){
		$this->Main_model->add_pieces();
		 redirect('pieces-master');
	}

	public function deletePieces(){
		$this->Main_model->disablePieces();
		redirect('pieces-master');
	} 

	public function updatePieces() {
	    $this->Main_model->update_pieces(); 
	    redirect('pieces-master');
	}
//----------------------------
		public function purchase_page()
	{
		if (!$this->session->userdata('user_id')) redirect('login');
	    $this->load->view('header');
	    $result['getRaw'] = $this->Main_model->getAllRaw(); // Passing the fetched data to the view
	    $result['getUnits'] = $this->Main_model->getAllUnits();
	    $result['getSupplier'] = $this->Main_model->getAllSupplier();
	    $result['getOrder'] = $this->Main_model->getAllOrders();
	    $this->load->view('purchase_order', $result);
	    $this->load->view('footer');
   }

   public function getUnitsByMaterial()
{
    $material_id = $this->input->post('material_id');
    if ($material_id) {
        $this->db->select('master_unit.id, master_unit.units');
        $this->db->from('master_unit');
        $this->db->join('master_raw', 'master_unit.id = master_raw.unit_id', 'left');
        $this->db->where('master_raw.id', $material_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            echo json_encode($query->result());
        } else {
            echo json_encode([]);
        }
    }
}

 public function savePurchaseOrder()
{
    $data = $this->input->post();

    // Validate required fields
    if (empty($data['invoice_no'])) {
        show_error('Invoice No is required');
    }

    // Insert into purchase_orders table
    $orderData = [
        'bill_date'     => $data['bill_date'],
        'supplier_id'   => $data['supplier_id'],
        'payment_mode'  => $data['payment_mode'],
        'total_amt'     => $data['total_amt'],
        'cash_discount' => $data['cash_discount'],
        'payable_amt'   => $data['payable_amt'],
        'paid_amt'      => $data['paid_amt'],
        'balance_amt'   => $data['balance_amt'],
        'invoice_no'    => $data['invoice_no'], // Pass the invoice_no here
    ];

    $this->db->insert('purchase_orders', $orderData);
    $purchase_order_id = $this->db->insert_id();

    // Insert into purchase_order_items table
    foreach ($data['raw_materials'] as $index => $material_id) {
        $itemData = [
            'purchase_order_id' => $purchase_order_id,
            'material_id'       => $material_id,
            'unit_id'           => $data['unit_id'][$index],
            'purchase_price'    => $data['purchase_price'][$index],
            'qty'               => $data['qty'][$index],
            'gross_amt'         => $data['gross_amt'][$index],
            'sgst'              => $data['sgst'][$index],
            'cgst'              => $data['cgst'][$index],
            'gst_amt'           => $data['gst_amt'][$index],
            'line_total'        => $data['line_total'][$index],
        ];
        $this->db->insert('purchase_order_details', $itemData);
    }

    // Redirect or return success
    redirect('purchase-order');
}

public function deleteOrder(){
		$this->Main_model->disableOrder();
		redirect('purchase-order');
	}

public function updatePurchase() {
    $this->Main_model->update_purchase();
    redirect('purchase-order'); // Redirect after update
}

//-----------------------------------

public function purchase_entry_page()
	{
		if (!$this->session->userdata('user_id')) redirect('login');
	    $this->load->view('header');
	    $result['getSupplier'] = $this->Main_model->getAllSupplier();
	    $result['getCash'] = $this->Main_model->getAllEntry();
	    $this->load->view('purchase_cash_entry', $result);
	    $this->load->view('footer');
   }

	public function getPaidAmount()
		{
		    $invoice_no = $this->input->post('invoice_no');
		    $this->load->model('Main_model'); // Ensure your model is loaded

		    $data = $this->Main_model->getPaidAmountByInvoice($invoice_no);

		    if ($data) {
		        echo json_encode([
		            'remaining_amt' => $data->remaining_amt ?? null,
		            'supp_name' => $data->supp_name ?? '',
		            'error' => null
		        ]);
		    } else {
		        echo json_encode([
		            'remaining_amt' => null,
		            'supp_name' => '',
		            'error' => 'No matching record found'
		        ]);
		    }
		}

  public function insertCashEntry(){
		$this->Main_model->add_cash_entry();
		 redirect('purchase-cash-entry');
	}

	public function deleteCash(){
		$this->Main_model->disableCash();
		redirect('purchase-cash-entry');
	}
//---------------------------------------

	public function manufacturing_stock_page()
	{
		if (!$this->session->userdata('user_id')) redirect('login');
	    $this->load->view('header');
	    $result['getRaw'] = $this->Main_model->getRawMaterialsAndUnits();
        $result['getPieces'] = $this->Main_model->getAllPieces();
        $result['getStocks'] = $this->Main_model->getMfdStock();
	    $this->load->view('manufacturing_stock', $result);
	    $this->load->view('footer');
   }

public function insertMfd_stock()
{
    $data = $this->input->post();

    // Validate required fields
    if (empty($data['product_name']) || empty($data['hsn_code'])) {
        $this->session->set_flashdata('error', 'Product name and HSN code are required.');
        redirect('manufacturing-stock');
        return;
    }

    // Prepare mfd_stock data
    $mfdStockData = [
        'product_name'    => $data['product_name'],
        'hsn_code'        => $data['hsn_code'],
        'pieces_packet'   => $data['pieces_packet'] ?? 0,
        'qty_in_kg'       => $data['qty_in_kg'] ?? 0,
        'qty_in_pieces'   => $data['qty_in_pieces'] ?? 0,
        'qty_in_packet'   => $data['qty_in_packet'] ?? 0,
        'qty_in_dozens'   => $data['qty_in_dozens'] ?? 0,
        'wholesale_price' => $data['wholesale_price'] ?? 0.0,
        'retail_price'    => $data['retail_price'] ?? 0.0,
        'sgst'            => $data['sgst'] ?? 0.0,
        'cgst'            => $data['cgst'] ?? 0.0,
        'date'            => $data['date'] ?? 0.0,
    ];

    // Start transaction
    $this->db->trans_start();

    // Check if product with the same name already exists
    $existingProduct = $this->db->get_where('mfd_stock', ['product_name' => $data['product_name']])->row();

    if ($existingProduct) {
        $mfd_stock_id = $existingProduct->id;
        // Product already exists, show a message for existing product
        $this->session->set_flashdata('info', 'Product already exists.');
    } else {
        // Insert new product into mfd_stock
        $this->db->insert('mfd_stock', $mfdStockData);
        $mfd_stock_id = $this->db->insert_id();

        // Show message for new product insertion
        $this->session->set_flashdata('success', 'New product inserted into stock.');

        // Insert new materials into mfd_stock_details
        $mfdStockDetails = [];
        foreach ($data['raw_materials'] as $index => $material) {
            $mfdStockDetails[] = [
                'mfd_stock_id' => $mfd_stock_id,
                'materials'    => $material,
                'quantity'     => $data['quantity'][$index] ?? 0,
                'units'        => $data['units'][$index] ?? '',
            ];
        }

        if (!empty($mfdStockDetails)) {
            $this->db->insert_batch('mfd_stock_details', $mfdStockDetails);
            // Show message for new material insertion
            $this->session->set_flashdata('success', 'New materials inserted into stock.');
        }
    }

    // Complete transaction
    $this->db->trans_complete();

    if ($this->db->trans_status() === false) {
        $this->session->set_flashdata('error', 'Failed to create/update stock entry.');
        redirect('manufacturing-stock');
        return;
    }

    // Final success message
    $this->session->set_flashdata('success', 'Stock entry processed successfully.');
    redirect('manufacturing-stock');
}

	public function deleteStock()
  {
    // Retrieve the ID from POST data
    $id = $this->input->post('dlt_id');

    if ($id) {
        // Call the model function to delete the stock
        $result = $this->Main_model->disableStock($id);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to delete stock entry.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid stock ID provided.']);
    }
    
    // Redirect back to the same page
    redirect('manufacturing-stock');
}

//----------------------------------

	public function daily_mfd_stock_page()
	{
		if (!$this->session->userdata('user_id')) redirect('login');
	    $this->load->view('header');
        $result['getPieces'] = $this->Main_model->getAllPieces();
        $result['getPN'] = $this->Main_model->getAllProductname();
        $result['getdailyStocks'] = $this->Main_model->getAllDailyStocks();
	    $this->load->view('daily_mfd_stock', $result);
	    $this->load->view('footer');
   }

    public function insertDailyStock(){
		$this->Main_model->add_daily_stock();
		 redirect('daily-mfd-stock');
	}

	public function deleteDailyMfd(){
		$this->Main_model->disableDailyMfd();
		redirect('daily-mfd-stock');
	}

//-------------------------------
  public function setting_page()
{
    $this->load->view('header');
    $query = $this->db->get('settings');
    $data['settings'] = ($query->num_rows() > 0) ? $query->row_array() : null;
    $this->load->view('settings', $data); // Pass $data to the view
    $this->load->view('footer');
}
 public function insert_settings(){
		$this->Main_model->add_settings();
		 redirect('settings');
	}
//-----------------------------------

public function sales_page()
{
    // Redirect to login if user is not logged in
    if (!$this->session->userdata('user_id')) redirect('login');

    // Load header view
    $this->load->view('header');

    // Fetch required data
    $result['getPN'] = $this->Main_model->getAllDailyStocks();
    $result['getSupplier'] = $this->Main_model->getAllSupplier();
    $result['getsales'] = $this->Main_model->getProductSales();

    // Fetch the latest bill number or initialize it
    $result['bill_no'] = $this->Main_model->getNewBillNumber();

    // Load views with data
    $this->load->view('sales', $result);
    $this->load->view('footer');
}

public function addSales()
{
    // Retrieve the POST data from the form
    $data = $this->input->post();

    // Generate a new bill number
    $newBillNumber = $this->Main_model->getNewBillNumber();

    // Insert data into the `product_sales_details` table
    $orderData = [
        'bill_date'       => $data['bill_date'],
        's_supplier_id'   => $data['s_supplier_id'],
        's_payment_mode'  => $data['s_payment_mode'],
        's_total_amt'     => $data['s_total_amt'],
        's_cash_discount' => $data['s_cash_discount'],
        's_payable_amt'   => $data['s_payable_amt'],
        's_paid_amt'      => $data['s_paid_amt'],
        's_balance_amt'   => $data['s_balance_amt'],
        'bill_no'         => $newBillNumber,
    ];

    $this->db->insert('product_sales_details', $orderData);
    $product_sale_detail_id = $this->db->insert_id(); // Get the inserted record's ID

    // Loop through dynamic product rows and insert them into the `product_sales` table
    if (!empty($data['product_name_id'])) {
        foreach ($data['product_name_id'] as $index => $product_name_id) {
            $itemData = [
                'product_sale_detail_id' => $product_sale_detail_id, // Foreign key
                'sl_no'                 => $data['sl_no'][$index],
                'product_name_id'       => $product_name_id,
                's_hsn_code'            => $data['s_hsn_code'][$index],
                's_pieces_pkt'          => $data['s_pieces_pkt'][$index],
                's_pkt_avl'             => $data['s_pkt_avl'][$index],
                's_dzn_avl'             => $data['s_dzn_avl'][$index],
                's_dozens'              => $data['s_dozens'][$index],
                's_net_qty'             => $data['s_net_qty'][$index],
                's_price_dzn'           => $data['s_price_dzn'][$index],
                's_price_pkt'           => $data['s_price_pkt'][$index],
                's_gross_amt'           => $data['s_gross_amt'][$index],
                's_sgst'                => $data['s_sgst'][$index],
                's_cgst'                => $data['s_cgst'][$index],
                's_gst_amt'             => $data['s_gst_amt'][$index],
                's_line_total'          => $data['s_line_total'][$index],
            ];
            $this->db->insert('product_sales', $itemData); // Insert each row
        }
    }

    // Redirect to the sales page or display a success message
    $this->session->set_flashdata('success', 'Sales added successfully!');
    redirect('sales');
}

//  public function addSales() {
//     if ($this->input->method() === 'post') {
//         // Load the Main_model if not already loaded
//         $this->load->model('Main_model');

//         // Generate new bill number
//         $newBillNumber = $this->Main_model->getNewBillNumber();

//         // Gather POST data
//         $data = [
//             'product_name_id' => $this->input->post('product_name_id'),
//             's_hsn_code' => $this->input->post('s_hsn_code'),
//             's_pieces_pkt' => $this->input->post('s_pieces_pkt'),
//             's_pkt_avl' => $this->input->post('s_pkt_avl'),
//             's_dzn_avl' => $this->input->post('s_dzn_avl'),
//             's_dozens' => $this->input->post('s_dozens'),
//             's_net_qty' => $this->input->post('s_net_qty'),
//             's_price_dzn' => $this->input->post('s_price_dzn'),
//             's_price_pkt' => $this->input->post('s_price_pkt'),
//             's_gross_amt' => $this->input->post('s_gross_amt'),
//             's_sgst' => $this->input->post('s_sgst'),
//             's_cgst' => $this->input->post('s_cgst'),
//             's_gst_amt' => $this->input->post('s_gst_amt'),
//             's_line_total' => $this->input->post('s_line_total')
//         ];

//         $sales_details = [
//         	'bill_no' => $newBillNumber,
//             'bill_date' => $this->input->post('bill_date'),
//             's_supplier_id' => $this->input->post('s_supplier_id'),
//             's_payment_mode' => $this->input->post('s_payment_mode'),
//             's_total_amt' => $this->input->post('s_total_amt'),
//             's_cash_discount' => $this->input->post('s_cash_discount'),
//             's_payable_amt' => $this->input->post('s_payable_amt'),
//             's_paid_amt' => $this->input->post('s_paid_amt'),
//             's_balance_amt' => $this->input->post('s_balance_amt')
//         ];

//         // Insert data
//         $insert_id = $this->Main_model->insertProductSales($data, $sales_details);

//         if ($insert_id) {
//             $this->session->set_flashdata('success', 'Order successfully added');
//             redirect('sales');
//         } else {
//             $this->session->set_flashdata('error', 'Failed to add order');
//             redirect('sales');
//         }
//     } else {
//         $this->load->view('sales');
//     }
// }

// public function deleteSales(){
// 		$this->Main_model->disableSales();
// 		redirect('sales');
// 	}

 //------------------------
  public function sales_entry_page()
	{
		if (!$this->session->userdata('user_id')) redirect('login');
	    $this->load->view('header');
	    $result['getPN'] = $this->Main_model->getAllProductname();
	    $result['getSupplier'] = $this->Main_model->getAllSupplier();
	    $result['getSaleCash'] = $this->Main_model->getAllSalesEntry();
	    $this->load->view('sales_cash_entry', $result);
	    $this->load->view('footer');
   }

 public function salesPaidAmount()
{
    $bill_no = $this->input->post('bill_no');
    $this->load->model('Main_model'); // Ensure your model is loaded
    $data = $this->Main_model->salesPaidAmountByInvoice($bill_no);

    // Check if data is valid and if there are any previous payments
    if ($data) {
        // If no entries have been made, return s_balance_amt as null (leave amount blank)
        if ($data->s_balance_amt === null || $data->s_balance_amt === 0) {
            echo json_encode(['s_balance_amt' => null, 'supp_name' => $data->supp_name]); // No balance
        } else {
            echo json_encode($data); // Return supplier name and balance information
        }
    } else {
        // No matching record found, return null
        echo json_encode(['error' => 'No matching record found']);
    }
}

public function insertSalesCashEntry(){
    $this->Main_model->sales_cash_entry();
    redirect('sales-cash-entry');
}

public function deleteSalesCash(){
		$this->Main_model->disableSalesCash();
		redirect('sales-cash-entry');
	}


//------------------
	public function print_SalesInvoice($bill_no) {
    // Fetch data from the model filtered by the bill number
    $items = $this->Main_model->getInvoiceSales($bill_no); 

    // Ensure items are returned as an array
    if (is_object($items)) {
        $items = $items->result_array();
    }

    // If no data found for the bill number, redirect or show error
    if (empty($items)) {
        show_error('No data found for the specified bill number.');
        return;
    }

    // Prepare data for the view
    $data['items'] = $items;
    $data['bill_no'] = $bill_no;  // Pass bill number to the view

    // Calculate totals
    $data['total_taxable_value'] = array_sum(array_column($data['items'], 's_gross_amt'));
    $data['total_value'] = array_sum(array_column($data['items'], 's_line_total'));

    // Load views
    $this->load->view('header');
    $this->load->view('sales_invoice', $data);
    $this->load->view('footer');
}
//---------------------------------

public function raw_material_report()
{
    if (!$this->session->userdata('user_id')) redirect('login');
    $this->load->view('header');
    
    // Fetch the stock data
    $result['getpurchaseOrder'] = $this->Main_model->getStock();

    // Pass the result to the view
    $this->load->view('Reports/raw_material_stock', $result);
    $this->load->view('footer');
}


//-------------------------------

public function purchase_report_page() {
    if (!$this->session->userdata('user_id')) redirect('login');
    
    $this->load->view('header');
    
    // Get filter inputs
    $filterName = $this->input->get('filtername');
    $filterInvoiceNo = $this->input->get('filterinvoiceno');
    $filterBillDate = $this->input->get('filterbilldate');

    // Fetch suppliers for dropdown
    $result['supp_name'] = $this->Main_model->get_purchaseSupplier();

    // Fetch filtered purchase orders
    $result['getPurchase'] = $this->Main_model->get_purchase_report($filterName, $filterInvoiceNo, $filterBillDate);

    $this->load->view('Reports/purchase_report', $result);
    $this->load->view('footer');
}

//-------------------------------

public function mfd_stock_report() {
    if (!$this->session->userdata('user_id')) redirect('login');
    $this->load->view('header');
  
    // Get filter inputs
    $filterName = $this->input->get('filtername');
    $filterHsnCode = $this->input->get('filterhsncode');
    $filterDate = $this->input->get('filterdate');

    // Fetch suppliers for dropdown
    $result['product_name'] = $this->Main_model->get_mfdStocks();

    // Fetch filtered sales data
    $result['stockData'] = $this->Main_model->get_mfd_rep($filterName, $filterHsnCode, $filterDate);

    $this->load->view('Reports/mfd_stock_rep', $result);
    $this->load->view('footer');
}

//--------------------------
public function ready_mfd_report()
{
    if (!$this->session->userdata('user_id')) redirect('login');
    $this->load->view('header');

    // Get filter inputs
    $filterName = $this->input->get('filtername');
    $filterDate = $this->input->get('filterdate');

    // Fetch suppliers for dropdown
    $result['product_name'] = $this->Main_model->get_product();

      // Fetch filtered sales data
    $result['getdailyStocks'] = $this->Main_model->getAllDailyReport($filterName, $filterDate);

     // // Debug the data
    // echo '<pre>';
    // print_r($result['getpurchaseOrder']);
    // echo '</pre>';
    // die(); // Stop execution to inspect the data

    $this->load->view('Reports/ready_mfd_stock', $result);
    $this->load->view('footer');
}
//------------------------------
public function sales_report()
{
    if (!$this->session->userdata('user_id')) redirect('login');

    // Get filter inputs
    $filterName = $this->input->get('filtername');
    $filterBillNo = $this->input->get('filterbillno');
    $filterBillDate = $this->input->get('filterbilldate');

    // Fetch suppliers for dropdown
    $result['supp_name'] = $this->Main_model->get_suppliers();

    // Fetch filtered sales data
    $result['getsales'] = $this->Main_model->get_filtered_sales($filterName, $filterBillNo, $filterBillDate);

    // // Loop over the sales data in your view and call updateReadyStock
    // if (!empty($result['getsales'])) {
    //     foreach ($result['getsales'] as $sale) {
    //         $this->Main_model->updateReadyStock($sale['product_id'], $sale['sold_pieces'], $sale['sold_packets'], $sale['sold_dozens']);
    //     }
    // }

    // Pass data to the view
    $this->load->view('header');
    $this->load->view('Reports/sales_billing_rep', $result); // Use $result instead of $data
    $this->load->view('footer');
}


}
