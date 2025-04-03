<?php 

class Main_model extends CI_Model
{
//---------------------------
   
    public function get_sales_data() {
        // Replace 'sales_table' with your actual table name
        $query = $this->db->get('product_sales_details');
        return $query;
    }

    public function get_total_payable_amount() {
        // Replace 'sales_table' with your table name
        $this->db->select_sum('s_payable_amt');
        $query = $this->db->get('product_sales_details');
        return $query->row()->s_payable_amt ?? 0; // Return 0 if no result
    }

     public function get_total_paid_amount() {
        // Replace 'sales_table' with your table name
        $this->db->select_sum('s_paid_amt');
        $query = $this->db->get('product_sales_details');
        return $query->row()->s_paid_amt ?? 0; // Return 0 if no result
    }

  public function get_total_balance_amount() {
    // Controller code
    $this->db->select('SUM(ps.s_line_total) as total_line_amt, SUM(psd.s_balance_amt) as total_balance_amt');
    $this->db->from('product_sales as ps');
    $this->db->join('product_sales_details as psd', 'ps.id = psd.product_sale_id', 'inner');
    $query = $this->db->get();

    $result = $query->row();

    // Safely calculate $total_balance
    return ($result->total_line_amt ?? 0) - ($result->total_balance_amt ?? 0);
}


//----------------------
	public function add_Custmoer()
{
    $response = ['data' => [], 'error' => '']; // Initialize response array

    if ($this->input->post('cust_name')) {
        $data = array(
            'cust_name' => $this->input->post('cust_name'),
            'cust_mobile_no' => $this->input->post('cust_mobile_no'),
            'cust_address' => $this->input->post('cust_address'), // Fixed
            'cust_gstin' => $this->input->post('cust_gstin') // Fixed
        );

        $result = $this->db->insert('reg_customer', $data);

        if ($result) {
            $this->session->set_flashdata('success_message', 'Data added successfully');
            $response['data'] = ['message' => 'Data added successfully']; // Add success message
        } else {
            $response['error'] = 'Failed to add data'; // Set error message
        }
    } else {
        $response['error'] = 'Invalid request'; // Set error message for invalid request
    }
    
    // Set JSON response without echoing
    $this->output
         ->set_content_type('application/json')
         ->set_output(json_encode($response));
}

	public function getAllCustomer()
		{
			$this->db->order_by('reg_customer.id', 'DESC');
	    	$query = $this->db->get("reg_customer");
		    if ($query->num_rows() > 0)
		    {
		        return $query;
		    }
	  	}

	 public function disableCustomer(){
    $response = ['data' => [], 'error' => ''];

    // Check if 'id' is provided in the POST request
    if ($this->input->post('dlt_id')) {
        // Retrieve the ID from the POST request
        $id = $this->input->post('dlt_id');
        
        // Perform the delete operation
        $this->db->where('id', $id);
        $result = $this->db->delete('reg_customer');

        if ($result) {
                    $this->session->set_flashdata('success_message', 'Data deleted successfully');
                } else {
                    //echo json_encode(['status' => 'error', 'message' => 'Failed to disable data mode']);
                }
   }
}
    public function update_customer() {
    $response = ['data' => [], 'error' => ''];
    if ($this->input->post('cust_name')) {
        $data = [
            'cust_name' => $this->input->post('cust_name'),
            'cust_mobile_no' => $this->input->post('cust_mobile_no'),
            'cust_address' => $this->input->post('cust_address'),
            'cust_gstin' => $this->input->post('cust_gstin'),
        ];

        $this->db->where('id', $this->input->post('id'));
        $result = $this->db->update('reg_customer', $data);

        if ($result) {
            $response['data'] = ['message' => 'Data updated successfully'];
        } else {
            $response['error'] = 'Failed to update data';
        }
    } else {
        $response['error'] = 'Invalid input';
    }

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
}
//------------------------------

public function add_supplier()
{
    $response = ['data' => [], 'error' => '']; // Initialize response array

    if ($this->input->post('supp_name')) {
        $data = array(
            'supp_name' => $this->input->post('supp_name'),
            'supp_mobile_no' => $this->input->post('supp_mobile_no'),
            'supp_address' => $this->input->post('supp_address'), // Fixed
            'supp_gstin' => $this->input->post('supp_gstin') // Fixed
        );

        $result = $this->db->insert('reg_supplier', $data);

        if ($result) {
            $this->session->set_flashdata('success_message', 'Data added successfully');
            $response['data'] = ['message' => 'Data added successfully']; // Add success message
        } else {
            $response['error'] = 'Failed to add data'; // Set error message
        }
    } else {
        $response['error'] = 'Invalid request'; // Set error message for invalid request
    }
    
    // Set JSON response without echoing
    $this->output
         ->set_content_type('application/json')
         ->set_output(json_encode($response));
}

	public function getAllSupplier()
		{
			$this->db->order_by('reg_supplier.id', 'DESC');
	    	$query = $this->db->get("reg_supplier");
		    if ($query->num_rows() > 0)
		    {
		        return $query;
		    }
	  	}

	 public function disableSupplier(){
    $response = ['data' => [], 'error' => ''];

    // Check if 'id' is provided in the POST request
    if ($this->input->post('dlt_id')) {
        // Retrieve the ID from the POST request
        $id = $this->input->post('dlt_id');
        
        // Perform the delete operation
        $this->db->where('id', $id);
        $result = $this->db->delete('reg_supplier');

        if ($result) {
                    $this->session->set_flashdata('success_message', 'Data deleted successfully');
                } else {
                    //echo json_encode(['status' => 'error', 'message' => 'Failed to disable data mode']);
                }
   }
}
    public function update_supplier() {
    $response = ['data' => [], 'error' => ''];
    if ($this->input->post('supp_name')) {
        $data = [
            'supp_name' => $this->input->post('supp_name'),
            'supp_mobile_no' => $this->input->post('supp_mobile_no'),
            'supp_address' => $this->input->post('supp_address'),
            'supp_gstin' => $this->input->post('supp_gstin'),
        ];

        $this->db->where('id', $this->input->post('id'));
        $result = $this->db->update('reg_supplier', $data);

        if ($result) {
            $response['data'] = ['message' => 'Data updated successfully'];
        } else {
            $response['error'] = 'Failed to update data';
        }
    } else {
        $response['error'] = 'Invalid input';
    }

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
}
//----------------------------

public function add_labour()
{
    $response = ['data' => [], 'error' => '']; // Initialize response array

    if ($this->input->post('lab_name')) {
        $data = array(
            'lab_name' => $this->input->post('lab_name'),
            'lab_mobile_no' => $this->input->post('lab_mobile_no'),
            'lab_address' => $this->input->post('lab_address'), // Fixed
            'lab_salary' => $this->input->post('lab_salary') // Fixed
        );

        $result = $this->db->insert('reg_labour', $data);

        if ($result) {
            $this->session->set_flashdata('success_message', 'Data added successfully');
            $response['data'] = ['message' => 'Data added successfully']; // Add success message
        } else {
            $response['error'] = 'Failed to add data'; // Set error message
        }
    } else {
        $response['error'] = 'Invalid request'; // Set error message for invalid request
    }
    
    // Set JSON response without echoing
    $this->output
         ->set_content_type('application/json')
         ->set_output(json_encode($response));
}

	public function getAllLabour()
		{
			$this->db->order_by('reg_labour.id', 'DESC');
	    	$query = $this->db->get("reg_labour");
		    if ($query->num_rows() > 0)
		    {
		        return $query;
		    }
	  	}

	 public function disableLabour(){
    $response = ['data' => [], 'error' => ''];

    // Check if 'id' is provided in the POST request
    if ($this->input->post('dlt_id')) {
        // Retrieve the ID from the POST request
        $id = $this->input->post('dlt_id');
        
        // Perform the delete operation
        $this->db->where('id', $id);
        $result = $this->db->delete('reg_labour');

        if ($result) {
                    $this->session->set_flashdata('success_message', 'Data deleted successfully');
                } else {
                    //echo json_encode(['status' => 'error', 'message' => 'Failed to disable data mode']);
                }
   }
}
    public function update_labour() {
    $response = ['data' => [], 'error' => ''];
    if ($this->input->post('lab_name')) {
        $data = [
            'lab_name' => $this->input->post('lab_name'),
            'lab_mobile_no' => $this->input->post('lab_mobile_no'),
            'lab_address' => $this->input->post('lab_address'),
            'lab_salary' => $this->input->post('lab_salary'),
        ];

        $this->db->where('id', $this->input->post('id'));
        $result = $this->db->update('reg_labour', $data);

        if ($result) {
            $response['data'] = ['message' => 'Data updated successfully'];
        } else {
            $response['error'] = 'Failed to update data';
        }
    } else {
        $response['error'] = 'Invalid input';
    }

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
}
//--------------------------------
    public function add_units()
{
    $response = ['data' => [], 'error' => '']; // Initialize response array

    if ($this->input->post('units')) {
        $data = array(
            'units' => $this->input->post('units')
        );

        $result = $this->db->insert('master_unit', $data);

        if ($result) {
            $this->session->set_flashdata('success_message', 'Data added successfully');
            $response['data'] = ['message' => 'Data added successfully']; // Add success message
        } else {
            $response['error'] = 'Failed to add data'; // Set error message
        }
    } else {
        $response['error'] = 'Invalid request'; // Set error message for invalid request
    }
    
    // Set JSON response without echoing
    $this->output
         ->set_content_type('application/json')
         ->set_output(json_encode($response));
}

	public function getAllUnits()
		{
			$this->db->order_by('master_unit.id', 'DESC');
	    	$query = $this->db->get("master_unit");
		    if ($query->num_rows() > 0)
		    {
		        return $query;
		    }
	  	}

	 public function disableUnits(){
    $response = ['data' => [], 'error' => ''];

    // Check if 'id' is provided in the POST request
    if ($this->input->post('dlt_id')) {
        // Retrieve the ID from the POST request
        $id = $this->input->post('dlt_id');
        
        // Perform the delete operation
        $this->db->where('id', $id);
        $result = $this->db->delete('master_unit');

        if ($result) {
                    $this->session->set_flashdata('success_message', 'Data deleted successfully');
                } else {
                    //echo json_encode(['status' => 'error', 'message' => 'Failed to disable data mode']);
                }
   }
}
    public function update_units() {
    $response = ['data' => [], 'error' => ''];
    if ($this->input->post('units')) {
        $data = [
            'units' => $this->input->post('units')
       
        ];

        $this->db->where('id', $this->input->post('id'));
        $result = $this->db->update('master_unit', $data);

        if ($result) {
            $response['data'] = ['message' => 'Data updated successfully'];
        } else {
            $response['error'] = 'Failed to update data';
        }
    } else {
        $response['error'] = 'Invalid input';
    }

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
}
//---------------------------------

 public function add_raw()
{
    $response = ['data' => [], 'error' => '']; // Initialize response array

    if ($this->input->post('raw_materials')) {
        $data = array(
            'raw_materials' => $this->input->post('raw_materials'),
            'unit_id' => $this->input->post('unit_id')
        );

        $result = $this->db->insert('master_raw', $data);

        if ($result) {
            $this->session->set_flashdata('success_message', 'Data added successfully');
            $response['data'] = ['message' => 'Data added successfully']; // Add success message
        } else {
            $response['error'] = 'Failed to add data'; // Set error message
        }
    } else {
        $response['error'] = 'Invalid request'; // Set error message for invalid request
    }
    
    // Set JSON response without echoing
    $this->output
         ->set_content_type('application/json')
         ->set_output(json_encode($response));
}

	 public function getAllRaw(){
	     $this->db->select('master_raw.*, master_unit.units');
		 $this->db->from('master_raw');
		 $this->db->join('master_unit', 'master_unit.id = master_raw.unit_id', 'left');
		 $master = $this->db->get();
		if($master->num_rows()> 0){
			return $master->result();
		} 
	}

	 public function disableRaw(){
    $response = ['data' => [], 'error' => ''];

    // Check if 'id' is provided in the POST request
    if ($this->input->post('dlt_id')) {
        // Retrieve the ID from the POST request
        $id = $this->input->post('dlt_id');
        
        // Perform the delete operation
        $this->db->where('id', $id);
        $result = $this->db->delete('master_raw');

        if ($result) {
                    $this->session->set_flashdata('success_message', 'Data deleted successfully');
                } else {
                    //echo json_encode(['status' => 'error', 'message' => 'Failed to disable data mode']);
                }
   }
}
    public function update_raw() {
    $response = ['data' => [], 'error' => ''];
    if ($this->input->post('raw_materials')) {
        $data = [
            'raw_materials' => $this->input->post('raw_materials'),
            'unit_id' => $this->input->post('unit_id')
       
        ];

        $this->db->where('id', $this->input->post('id'));
        $result = $this->db->update('master_raw', $data);

        if ($result) {
            $response['data'] = ['message' => 'Data updated successfully'];
        } else {
            $response['error'] = 'Failed to update data';
        }
    } else {
        $response['error'] = 'Invalid input';
    }

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
}
//----------------------------------
public function add_pieces()
{
    $response = ['data' => [], 'error' => '']; // Initialize response array

    if ($this->input->post('pieces_pp')) {
        $data = array(
            'pieces_pp' => $this->input->post('pieces_pp')
        );

        $result = $this->db->insert('master_pieces', $data);

        if ($result) {
            $this->session->set_flashdata('success_message', 'Data added successfully');
            $response['data'] = ['message' => 'Data added successfully']; // Add success message
        } else {
            $response['error'] = 'Failed to add data'; // Set error message
        }
    } else {
        $response['error'] = 'Invalid request'; // Set error message for invalid request
    }
    
    // Set JSON response without echoing
    $this->output
         ->set_content_type('application/json')
         ->set_output(json_encode($response));
}

	public function getAllPieces()
		{
			$this->db->order_by('master_pieces.id', 'DESC');
	    	$query = $this->db->get("master_pieces");
		    if ($query->num_rows() > 0)
		    {
		        return $query;
		    }
	  	}

	 public function disablePieces(){
    $response = ['data' => [], 'error' => ''];

    // Check if 'id' is provided in the POST request
    if ($this->input->post('dlt_id')) {
        // Retrieve the ID from the POST request
        $id = $this->input->post('dlt_id');
        
        // Perform the delete operation
        $this->db->where('id', $id);
        $result = $this->db->delete('master_pieces');

        if ($result) {
                    $this->session->set_flashdata('success_message', 'Data deleted successfully');
                } else {
                    //echo json_encode(['status' => 'error', 'message' => 'Failed to disable data mode']);
                }
   }
}
    public function update_pieces() {
    $response = ['data' => [], 'error' => ''];
    if ($this->input->post('pieces_pp')) {
        $data = [
            'pieces_pp' => $this->input->post('pieces_pp')
       
        ];

        $this->db->where('id', $this->input->post('id'));
        $result = $this->db->update('master_pieces', $data);

        if ($result) {
            $response['data'] = ['message' => 'Data updated successfully'];
        } else {
            $response['error'] = 'Failed to update data';
        }
    } else {
        $response['error'] = 'Invalid input';
    }

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
}
//--------------------

  public function insertPurchaseOrder($purchaseOrderData, $purchaseOrderDetails)
    {
        $this->db->trans_start(); // Start transaction

        // Insert into purchase_orders table
        $this->db->insert('purchase_orders', $purchaseOrderData);
        $purchaseOrderId = $this->db->insert_id();

        // Insert into purchase_order_details table
        foreach ($purchaseOrderDetails as &$detail) {
            $detail['purchase_order_id'] = $purchaseOrderId; // Associate with the main table
        }
        $this->db->insert_batch('purchase_order_details', $purchaseOrderDetails);

        $this->db->trans_complete(); // Complete transaction

        // Check transaction status
        return $this->db->trans_status();
    }

   public function getAllOrders()
{
    $this->db->select('
        purchase_orders.id, 
        purchase_orders.invoice_no, 
        purchase_orders.bill_date, 
        purchase_orders.payable_amt, 
        purchase_orders.paid_amt, 
        purchase_orders.balance_amt, 
        purchase_order_details.line_total, 
        reg_supplier.supp_name, 
        reg_supplier.supp_mobile_no
    ');
    $this->db->from('purchase_orders');
    $this->db->join('reg_supplier', 'purchase_orders.supplier_id = reg_supplier.id', 'left');
    $this->db->join('purchase_order_details', 'purchase_orders.id = purchase_order_details.purchase_order_id', 'left'); // Correct join
    $query = $this->db->get();
    return $query;
}

public function disableOrder()
{
    // Initialize the response
    $response = ['status' => false, 'message' => ''];

    // Check if 'dlt_id' is provided in the POST request
    if ($this->input->post('dlt_id')) {
        // Retrieve and sanitize the ID from the POST request
        $id = intval($this->input->post('dlt_id'));

        // Begin a database transaction
        $this->db->trans_start();

        // Delete from `purchase_order_details` using foreign key
        $this->db->where('purchase_order_id', $id); // Assuming foreign key is `purchase_order_id`
        $this->db->delete('purchase_order_details');

        // Delete from `purchase_orders`
        $this->db->where('id', $id);
        $this->db->delete('purchase_orders');

        // Complete the transaction
        $this->db->trans_complete();

        // Check transaction status
        if ($this->db->trans_status() === FALSE) {
            $response['message'] = 'Failed to delete data. Please try again.';
            $this->session->set_flashdata('error_message', 'Failed to delete data');
        } else {
            $response['status'] = true;
            $response['message'] = 'Data deleted successfully.';
            $this->session->set_flashdata('success_message', 'Data deleted successfully');
        }
    } else {
        // Invalid ID or no ID provided
        $response['message'] = 'Invalid ID provided.';
    }

    // Return the response as JSON
    echo json_encode($response);
}

public function update_purchase() {
    $response = ['data' => [], 'error' => ''];

    // Validate required fields
    if ($this->input->post('invoice_no') && $this->input->post('id')) {
        $data = [
            'invoice_no' => $this->input->post('invoice_no'),
            'bill_date' => $this->input->post('bill_date'),
            'payable_amt' => $this->input->post('payable_amt'),
            'paid_amt' => $this->input->post('paid_amt'),
            'balance_amt' => $this->input->post('balance_amt')
            // 'supplier_id' => $this->input->post('supplier_id')
            // 'supp_mobile_no' => $this->input->post('supp_mobile_no')
        ];

        $stock_details = [
            'line_total' => $this->input->post('line_total')
            // 'quantity' => $this->input->post('quantity'),
            // 'units' => $this->input->post('units')
        ];

        // Start Transaction
        $this->db->trans_start();

        // Update mfd_stock table
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('purchase_orders', $data);

        // Update mfd_stock_details table
        $this->db->where('purchase_order_id', $this->input->post('id'));
        $this->db->update('purchase_order_details', $stock_details);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $response['error'] = 'Failed to update data';
        } else {
            $response['data'] = ['message' => 'Data updated successfully'];
        }
    } else {
        $response['error'] = 'Invalid input or missing required fields';
    }

    // Return response as JSON
    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
}


//-----------------------------------

public function add_cash_entry()
{
    $response = ['data' => [], 'error' => '']; // Initialize response array

    if ($this->input->post('invoice_no')) {
        $data = array(
            'invoice_no' => $this->input->post('invoice_no'),
            'supplier_name' => $this->input->post('supplier_name'), // Fetch supplier name directly
            'amount' => $this->input->post('amount'),
            'payment_mode' => $this->input->post('payment_mode'),
            'date_time' => $this->input->post('date_time'), // Ensure the name matches your form
            'remarks' => $this->input->post('remarks'),
        );

        $result = $this->db->insert('purchase_entry', $data);

        if ($result) {
            $this->session->set_flashdata('success_message', 'Data added successfully');
            $response['data'] = ['message' => 'Data added successfully']; // Add success message
        } else {
            $response['error'] = 'Failed to add data'; // Set error message
        }
    } else {
        $response['error'] = 'Invalid request'; // Set error message for invalid request
    }
    
    // Set JSON response without echoing
    $this->output
         ->set_content_type('application/json')
         ->set_output(json_encode($response));
} 

    public function getAllEntry()
        {
            $this->db->order_by('purchase_entry.id', 'DESC');
            $query = $this->db->get("purchase_entry");
            if ($query->num_rows() > 0)
            {
                return $query;
            }
        }

    public function getPaidAmountByInvoice($invoice_no)
{
    $this->db->select('payable_amt, paid_amt, reg_supplier.supp_name');
    $this->db->from('purchase_orders');
    $this->db->join('reg_supplier', 'purchase_orders.supplier_id = reg_supplier.id', 'left');
    $this->db->where('invoice_no', $invoice_no);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $row = $query->row();

        // Fetch total paid amount from purchase_entry table
        $this->db->select_sum('amount');
        $this->db->from('purchase_entry');
        $this->db->where('invoice_no', $invoice_no);
        $entry_query = $this->db->get();

        $payableAmount = $row->payable_amt ?? 0; // Ensure payable_amt is not null
        $pre_paid_amt = $row->paid_amt ?? 0; // Ensure paid_amt is not null
        $paidAmount = $entry_query->row()->amount ?? 0; // Ensure amount is not null

        // Calculate the remaining balance
        $row->remaining_amt = $payableAmount - $paidAmount - $pre_paid_amt;

        return $row; // Return the result
    }
    return null; // Return null if no record is found
}

 public function disableCash(){
    $response = ['data' => [], 'error' => ''];

    // Check if 'id' is provided in the POST request
    if ($this->input->post('dlt_id')) {
        // Retrieve the ID from the POST request
        $id = $this->input->post('dlt_id');
        
        // Perform the delete operation
        $this->db->where('id', $id);
        $result = $this->db->delete('purchase_entry');

        if ($result) {
                    $this->session->set_flashdata('success_message', 'Data deleted successfully');
                } else {
                    //echo json_encode(['status' => 'error', 'message' => 'Failed to disable data mode']);
                }
   }
}

//-------------------------------
public function add_settings()
{
    $response = ['data' => [], 'error' => ''];

    $this->load->library('form_validation');
    $this->form_validation->set_rules('pieces_per_kg', 'Pieces Per Kg', 'required|numeric');
    $this->form_validation->set_rules('plastic_packet_per_kg', 'Plastic Packet Per Kg', 'required|numeric');
    $this->form_validation->set_rules('mfd_critical_stock', 'MFD Critical Stock', 'required|numeric');

    if ($this->form_validation->run() == FALSE) {
        $response['error'] = validation_errors();
    } else {
        $data = [
            'pieces_per_kg' => $this->input->post('pieces_per_kg'),
            'plastic_packet_per_kg' => $this->input->post('plastic_packet_per_kg'),
            'mfd_critical_stock' => $this->input->post('mfd_critical_stock')
        ];

        // Check if a row already exists
        $query = $this->db->get('settings');

        if ($query->num_rows() > 0) {
            // Update existing row
            $this->db->where('id', $query->row()->id); // Assuming `id` is the primary key
            $result = $this->db->update('settings', $data);
        } else {
            // Insert new row
            $result = $this->db->insert('settings', $data);
        }

        if ($result) {
            $this->session->set_flashdata('success_message', 'Data saved successfully');
            $response['data'] = ['message' => 'Data saved successfully'];
        } else {
            $response['error'] = 'Failed to save data';
        }
         // Redirect back to the same page
         redirect('settings');
    }

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
}
//-----------------------------------

public function getRawMaterialsAndUnits() {
    // Query to get raw materials and their units
    $this->db->select('pod.material_id, m.raw_materials, u.units');
    $this->db->from('purchase_order_details pod');
    $this->db->join('master_raw m', 'pod.material_id = m.id', 'left');
    $this->db->join('master_unit u', 'pod.unit_id = u.id', 'left');
    $this->db->group_by('pod.material_id');
    $query = $this->db->get();

    return $query->result();  // Return the result to be passed to the view
}

 public function insertMfdStock($mfdStockData, $mfdStockDetails)
    {
        $this->db->trans_start(); // Start transaction

        // Insert into `mfd_stock` table
        $this->db->insert('mfd_stock', $mfdStockData);
        $mfdStockId = $this->db->insert_id(); // Get last inserted ID

        // Prepare details data
        foreach ($mfdStockDetails as &$detail) {
            $detail['mfd_stock_id'] = $mfdStockId;
        }

        // Insert into `mfd_stock_details` table
        if (!empty($mfdStockDetails)) {
            $this->db->insert_batch('mfd_stock_details', $mfdStockDetails);
        }

        $this->db->trans_complete(); // Complete transaction

        // Return transaction status
        return $this->db->trans_status();
    }

   public function getMfdStock()
{
    $this->db->select('
        mfd_stock.id as stock_id,
        mfd_stock.product_name,
        mfd_stock.hsn_code,
        mfd_stock.qty_in_dozens,
        master_pieces.pieces_pp,
        mfd_stock.wholesale_price,
        mfd_stock.retail_price,
        mfd_stock.sgst,
        mfd_stock.cgst,
        mfd_stock.date,
        mfd_stock_details.materials,
        mfd_stock_details.quantity,
        mfd_stock_details.units,
        master_raw.raw_materials
    ');
    $this->db->from('mfd_stock');
    $this->db->join('mfd_stock_details', 'mfd_stock.id = mfd_stock_details.mfd_stock_id', 'left');
    $this->db->join('master_pieces', 'mfd_stock.pieces_packet = master_pieces.id', 'left');
    $this->db->join('master_raw', 'mfd_stock_details.materials = master_raw.id', 'left'); // Added this join
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->result(); // Returns the result as an array of objects
    } else {
        return null; // No data found
    }
}

     public function getAllProductname()
    {
        $this->db->select('mfd_stock.id, mfd_stock.product_name, mfd_stock.hsn_code, master_pieces.pieces_pp, daily_mfd_stock.qty_in_packet, daily_mfd_stock.qty_in_dozens');
        $this->db->from('mfd_stock');
        $this->db->join('daily_mfd_stock', 'mfd_stock.id = daily_mfd_stock.product_name_id', 'left');
        $this->db->join('master_pieces', 'daily_mfd_stock.pieces_packet = master_pieces.id', 'left');
        $this->db->order_by('mfd_stock.product_name', 'DESC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return [];
        }
    }
    
    public function disableStock($id)
{
    // Begin a transaction to ensure data consistency
    $this->db->trans_start();

    // Delete the entry from `mfd_stock_details`
    $this->db->where('mfd_stock_id', $id);
    $this->db->delete('mfd_stock_details');

    // Delete the entry from `mfd_stock`
    $this->db->where('id', $id);
    $this->db->delete('mfd_stock');

    // Complete the transaction
    $this->db->trans_complete();

    // Return the transaction status
    return $this->db->trans_status();
}

//----------------------------------------

public function add_daily_stock()
{
    $response = ['data' => [], 'error' => '']; // Initialize response array

    if ($this->input->post('product_name_id')) {
        $data = array(
            'product_name_id' => $this->input->post('product_name_id'),
            'pieces_packet' => $this->input->post('pieces_packet'),
            'qty_in_kg' => $this->input->post('qty_in_kg'), // Fixed
            'qty_in_pieces' => $this->input->post('qty_in_pieces'), // Fixed
            'qty_in_packet' => $this->input->post('qty_in_packet'), // Fixed
            'qty_in_dozens' => $this->input->post('qty_in_dozens'), // Fixed
            'date' => $this->input->post('date') // Fixed

        );

        $result = $this->db->insert('daily_mfd_stock', $data);

        if ($result) {
            $this->session->set_flashdata('success_message', 'Data added successfully');
            $response['data'] = ['message' => 'Data added successfully']; // Add success message
        } else {
            $response['error'] = 'Failed to add data'; // Set error message
        }
    } else {
        $response['error'] = 'Invalid request'; // Set error message for invalid request
    }
    
    // Set JSON response without echoing
    $this->output
         ->set_content_type('application/json')
         ->set_output(json_encode($response));
}

// public function add_daily_stock()
// {
//     // Load POST data
//     $productNameId = $this->input->post('product_name_id');
//     $piecesPacket = $this->input->post('pieces_packet');
//     $qtyInKg = $this->input->post('qty_in_kg');
//     $qtyInPieces = $this->input->post('qty_in_pieces');
//     $qtyInPacket = $this->input->post('qty_in_packet');
//     $qtyInDozens = $this->input->post('qty_in_dozens');

//     // Check if the record already exists
//     $this->db->where('product_name_id', $productNameId);
//     $existingStock = $this->db->get('daily_mfd_stock')->row();

//     if ($existingStock) {
//         // Update the existing record by adding new quantities
//         $updateData = [
//             'qty_in_kg' => $existingStock->qty_in_kg + $qtyInKg,
//             'qty_in_pieces' => $existingStock->qty_in_pieces + $qtyInPieces,
//             'qty_in_packet' => $existingStock->qty_in_packet + $qtyInPacket,
//             'qty_in_dozens' => $existingStock->qty_in_dozens + $qtyInDozens
//         ];

//         $this->db->where('id', $existingStock->id);
//         $this->db->update('daily_mfd_stock', $updateData);
//     } else {
//         // Insert a new record
//         $insertData = [
//             'product_name_id' => $productNameId,
//             'pieces_packet' => $piecesPacket,
//             'qty_in_kg' => $qtyInKg,
//             'qty_in_pieces' => $qtyInPieces,
//             'qty_in_packet' => $qtyInPacket,
//             'qty_in_dozens' => $qtyInDozens
//         ];

//         $this->db->insert('daily_mfd_stock', $insertData);
//     }

//     // Redirect back with a success message
//     $this->session->set_flashdata('success', 'Stock updated successfully.');
//     redirect('daily-mfd-stock');
// }

 // public function getAllProductname()
 //    {
 //        $this->db->select('mfd_stock.id, mfd_stock.product_name, mfd_stock.hsn_code, master_pieces.pieces_pp, daily_mfd_stock.qty_in_packet, daily_mfd_stock.qty_in_dozens');
 //        $this->db->from('mfd_stock');
 //        $this->db->join('daily_mfd_stock', 'mfd_stock.id = daily_mfd_stock.product_name_id', 'left');
 //        $this->db->join('master_pieces', 'daily_mfd_stock.pieces_packet = master_pieces.id', 'left');
 //        $this->db->order_by('mfd_stock.product_name', 'DESC');
 //        $query = $this->db->get();

 //        if ($query->num_rows() > 0) {
 //            return $query->result();
 //        } else {
 //            return [];
 //        }
 //    }

public function getAllDailyStocks() 
{
    $this->db->select('
        daily_mfd_stock.id as dailystock_id,
        mfd_stock.id as product_id,
        mfd_stock.product_name,
        mfd_stock.hsn_code,
        master_pieces.pieces_pp,
        daily_mfd_stock.qty_in_kg,
        daily_mfd_stock.qty_in_pieces,
        daily_mfd_stock.qty_in_packet,
        daily_mfd_stock.qty_in_dozens,
        daily_mfd_stock.date,
        mfd_stock.wholesale_price,
        mfd_stock.retail_price
    ');
    $this->db->from('daily_mfd_stock');
    $this->db->join('mfd_stock', 'daily_mfd_stock.product_name_id = mfd_stock.id', 'left');
    $this->db->join('master_pieces', 'daily_mfd_stock.pieces_packet = master_pieces.id', 'left');
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->result(); // Return data as an array of objects
    }

    return []; // Return an empty array if no data is found
}

public function disableDailyMfd(){
    $response = ['data' => [], 'error' => ''];

    // Check if 'id' is provided in the POST request
    if ($this->input->post('dlt_id')) {
        // Retrieve the ID from the POST request
        $id = $this->input->post('dlt_id');
        
        // Perform the delete operation
        $this->db->where('id', $id);
        $result = $this->db->delete('daily_mfd_stock');

        if ($result) {
                    $this->session->set_flashdata('success_message', 'Data deleted successfully');
                } else {
                    //echo json_encode(['status' => 'error', 'message' => 'Failed to disable data mode']);
                }
   }
}

//-------------------------------------

//    public function insertProductSales($product_sales_data, $product_sales_details_data) {
//     $this->db->trans_start(); // Start transaction

//     // Insert into product_sales table
//     $this->db->insert('product_sales', $product_sales_data);
//     $product_sale_id = $this->db->insert_id(); // Get the last inserted ID

//     // Add the product_sale_id to product_sales_details_data
//     $product_sales_details_data['product_sale_id'] = $product_sale_id;

//     // Insert into product_sales_details table
//     $this->db->insert('product_sales_details', $product_sales_details_data);

//     $this->db->trans_complete(); // End transaction

//     // Check if transaction was successful
//     return $this->db->trans_status() ? $product_sale_id : false;
// }

 public function getProductSales()
{
   $this->db->select('
    product_sales_details.id, 
    product_sales_details.bill_no, 
    product_sales_details.bill_date, 
    product_sales_details.s_payable_amt, 
    product_sales_details.s_cash_discount, 
    product_sales_details.s_paid_amt, 
    product_sales_details.s_balance_amt,
    product_sales.s_line_total, 
    reg_supplier.supp_name 
');
    $this->db->from('product_sales_details');
    $this->db->join('reg_supplier', 'product_sales_details.s_supplier_id = reg_supplier.id', 'left');
    $this->db->join('product_sales', 'product_sales_details.id = product_sales.product_sale_detail_id', 'left');
    $query = $this->db->get();
    return $query;
}

  public function getNewBillNumber() {
    $this->db->select_max('bill_no');
    $query = $this->db->get('product_sales_details');
    $result = $query->row();

    return $result && $result->bill_no ? $result->bill_no + 1 : 1; // Start with 1 if no record exists
}

// public function disableSales()
// {
//     // Initialize the response
//     $response = ['status' => false, 'message' => ''];

//     // Check if 'dlt_id' is provided in the POST request
//     if ($this->input->post('dlt_id')) {
//         // Retrieve and sanitize the ID from the POST request
//         $id = intval($this->input->post('dlt_id'));

//         // Begin a database transaction
//         $this->db->trans_start();

//         // Delete from `product_sales_details` using foreign key
//         $this->db->where('product_sale_id', $id); // Assuming foreign key is `product_sale_id`
//         $this->db->delete('product_sales_details');

//         // Delete from `product_sales`
//         $this->db->where('id', $id);
//         $this->db->delete('product_sales');

//         // Complete the transaction
//         $this->db->trans_complete();

//         // Check transaction status
//         if ($this->db->trans_status() === FALSE) {
//             $response['message'] = 'Failed to delete data. Please try again.';
//             $this->session->set_flashdata('error_message', 'Failed to delete data');
//         } else {
//             $response['status'] = true;
//             $response['message'] = 'Data deleted successfully.';
//             $this->session->set_flashdata('success_message', 'Data deleted successfully');
//         }
//     } else {
//         // Invalid ID or no ID provided
//         $response['message'] = 'Invalid ID provided.';
//     }

//     // Return the response as JSON
//     echo json_encode($response);
// }

//---------------------

public function salesPaidAmountByInvoice($bill_no)
{
    $this->db->select('s_payable_amt, s_paid_amt, reg_supplier.supp_name');
    $this->db->from('product_sales_details');
    $this->db->join('reg_supplier', 'product_sales_details.s_supplier_id = reg_supplier.id', 'left');
    $this->db->where('bill_no', $bill_no);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $row = $query->row();

        // Fetch total paid amount from sales_entry table
        $this->db->select_sum('amount');
        $this->db->from('sales_entry');
        $this->db->where('bill_no', $bill_no);
        $entry_query = $this->db->get();

        $payableAmount = $row->s_payable_amt ?? 0; // Ensure s_payable_amt is not null
        $pre_paidAmount = $row->s_paid_amt ?? 0; // Ensure s_paid_amt is not null (comes from product_sales_details)
        $paidAmount = $entry_query->row()->amount ?? 0; // Ensure amount is not null (from sales_entry)

        // Calculate the remaining balance
        $row->s_balance_amt = $payableAmount - $paidAmount - $pre_paidAmount;

        return $row; // Return the result
    }
    return null; // Return null if no record is found
}


 public function sales_cash_entry()
        {
            $response = ['data' => [], 'error' => '']; // Initialize response array

            if ($this->input->post('bill_no')) {
                $data = array(
                    // 'product_name' => $this->input->post('product_name'),
                    'bill_no' => $this->input->post('bill_no'), // Fetch supplier name directly
                    'amount' => $this->input->post('amount'),
                    'supplier_name' => $this->input->post('supplier_name'),
                    'payment_mode' => $this->input->post('payment_mode'), // Ensure the name matches your form
                    'date_time' => $this->input->post('date_time'),
                );

                $result = $this->db->insert('sales_entry', $data);

                if ($result) {
                    $this->session->set_flashdata('success_message', 'Data added successfully');
                    $response['data'] = ['message' => 'Data added successfully']; // Add success message
                } else {
                    $response['error'] = 'Failed to add data'; // Set error message
                }
            } else {
                $response['error'] = 'Invalid request'; // Set error message for invalid request
            }
            
            // Set JSON response without echoing
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode($response));
        } 

       public function getAllSalesEntry()
    {
        $this->db->select('sales_entry.*'); // Select fields
        $this->db->from('sales_entry'); // Main table
        // $this->db->join('mfd_stock', 'sales_entry.product_name = mfd_stock.id', 'left'); // Join with mfd_stock
        $this->db->order_by('sales_entry.id', 'DESC'); // Order by ID in descending order
        $query = $this->db->get(); // Get results

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return null; // Return null if no results
        }
    }

    public function disableSalesCash(){
    $response = ['data' => [], 'error' => ''];

    // Check if 'id' is provided in the POST request
    if ($this->input->post('dlt_id')) {
        // Retrieve the ID from the POST request
        $id = $this->input->post('dlt_id');
        
        // Perform the delete operation
        $this->db->where('id', $id);
        $result = $this->db->delete('sales_entry');

        if ($result) {
                    $this->session->set_flashdata('success_message', 'Data deleted successfully');
                } else {
                    //echo json_encode(['status' => 'error', 'message' => 'Failed to disable data mode']);
                }
   }
}

//-------------------------
   public function getInvoiceSales($bill_no) {
    $this->db->select('
        product_sales.id,
        mfd_stock.id as product_id,
        mfd_stock.product_name,
        product_sales_details.bill_no,
        product_sales.s_hsn_code,
        product_sales.s_dozens,
        product_sales.s_pieces_pkt,
        product_sales.s_sgst,
        product_sales.s_cgst,
        product_sales.s_gst_amt,
        product_sales.s_line_total
    ');
    
    $this->db->from('product_sales');
    $this->db->join('product_sales_details', 'product_sales.product_sale_detail_id = product_sales_details.id', 'left');
    $this->db->join('mfd_stock', 'product_sales.product_name_id = mfd_stock.id', 'left');
    
    // Add condition to filter by bill number
    $this->db->where('product_sales_details.bill_no', $bill_no);

    $query = $this->db->get();
    return $query;
}
//-------------------------

// public function getStock() {
//     $this->db->select('
//         po.id AS purchase_order_id,
//         pod.material_id,
//         m.raw_materials AS raw_materials,
//         pod.unit_id,
//         u.units AS unit_name,
//         SUM(pod.qty) AS total_quantity,
//         msd.quantity AS mfd_quantity,
//         msd.units AS mfd_unit,
//         msd.materials,
//         GROUP_CONCAT(msd.mfd_stock_id) AS mfd_stock_ids,
//         GROUP_CONCAT(dms.product_name_id) AS product_name_ids,
//         dms.qty_in_kg,
//         (CASE 
//             WHEN msd.mfd_stock_id = dms.product_name_id 
//                  AND pod.material_id = msd.materials THEN (SUM(pod.qty) - (dms.qty_in_kg * msd.quantity)) 
//             ELSE SUM(pod.qty)
//          END) AS remaining_qty
//     ');

//     $this->db->from('purchase_orders po');
//     $this->db->join('purchase_order_details pod', 'po.id = pod.purchase_order_id', 'inner');
//     $this->db->join('master_raw m', 'pod.material_id = m.id', 'left');
//     $this->db->join('master_unit u', 'pod.unit_id = u.id', 'left');
//     $this->db->join('mfd_stock_details msd', 'pod.material_id = msd.materials', 'left'); // Join mfd_stock_details
//     $this->db->join('daily_mfd_stock dms', 'msd.mfd_stock_id = dms.product_name_id', 'left'); // Join daily_mfd_stock

//     // Group by both material_id and unit_id to calculate total_quantity correctly
//     $this->db->group_by(['pod.material_id', 'pod.unit_id']);
//     $this->db->order_by('po.id', 'ASC');

//     $query = $this->db->get();
//     return $query->result();
// }


public function getStock() {
    // Subquery to calculate total_qty
    $this->db->select('
        pod.material_id, 
        SUM(pod.qty) AS total_qty
    ');
    $this->db->from('purchase_order_details pod');
    $this->db->group_by('pod.material_id');
    $subquery = $this->db->get_compiled_select();

    // Subquery to calculate the total deduction
    $this->db->select('
        msd.materials AS material_id,
        SUM(msd.quantity * dms.qty_in_kg) AS total_deduction
    ');
    $this->db->from('mfd_stock_details msd');
    $this->db->join('daily_mfd_stock dms', 'msd.mfd_stock_id = dms.product_name_id', 'inner');
    $this->db->group_by('msd.materials');
    $deduction_subquery = $this->db->get_compiled_select();

    // Main query
    $this->db->select('
        GROUP_CONCAT(DISTINCT po.id) AS purchase_order_id,
        pod.material_id,
        m.raw_materials AS raw_materials,
        pod.unit_id,
        u.units AS unit_name,
        total_qty_subquery.total_qty,
        GROUP_CONCAT(DISTINCT msd.quantity ORDER BY msd.quantity DESC) AS mfd_quantities,
        msd.units AS mfd_unit,
        GROUP_CONCAT(DISTINCT msd.mfd_stock_id ORDER BY msd.mfd_stock_id) AS mfd_stock_ids,
        GROUP_CONCAT(DISTINCT dms.product_name_id ORDER BY dms.product_name_id) AS product_name_ids,
        GROUP_CONCAT(DISTINCT dms.qty_in_kg ORDER BY dms.qty_in_kg) AS qty_in_kgs,
        (total_qty_subquery.total_qty - COALESCE(deduction_subquery.total_deduction, 0)) AS remaining_qty
    ');

    $this->db->from('purchase_orders po');
    $this->db->join('purchase_order_details pod', 'po.id = pod.purchase_order_id', 'inner');
    $this->db->join('master_raw m', 'pod.material_id = m.id', 'left');
    $this->db->join('master_unit u', 'pod.unit_id = u.id', 'left');
    $this->db->join('mfd_stock_details msd', 'pod.material_id = msd.materials', 'left');
    $this->db->join('daily_mfd_stock dms', 'msd.mfd_stock_id = dms.product_name_id', 'left');

    // Join the subqueries
    $this->db->join("($subquery) AS total_qty_subquery", 'pod.material_id = total_qty_subquery.material_id', 'inner');
    $this->db->join("($deduction_subquery) AS deduction_subquery", 'pod.material_id = deduction_subquery.material_id', 'left');

    // Group and order
    $this->db->group_by('pod.material_id, m.raw_materials, pod.unit_id, u.units');
    $this->db->order_by('po.id', 'ASC');

    $query = $this->db->get();
    return $query->result();
}


// public function getStock() {
//     $this->db->select('
//         m.raw_materials AS raw_materials,
//         pod.qty AS total_qty,
//         pod.unit_id,
//         u.units AS unit_name,
//         GROUP_CONCAT(DISTINCT msd.quantity) AS mfd_quantities,
//         msd.units AS mfd_unit,
//         GROUP_CONCAT(DISTINCT msd.mfd_stock_id) AS mfd_stock_ids,
//         GROUP_CONCAT(DISTINCT dms.product_name_id) AS product_name_ids,
//         GROUP_CONCAT(DISTINCT dms.qty_in_kg) AS qty_in_kgs,
//         (CASE 
//             WHEN msd.mfd_stock_id = dms.product_name_id THEN (pod.qty - (dms.qty_in_kg * msd.quantity)) 
//             ELSE pod.qty 
//          END) AS remaining_qty
//     ');

//     $this->db->from('purchase_orders po');
//     $this->db->join('purchase_order_details pod', 'po.id = pod.purchase_order_id', 'inner');
//     $this->db->join('master_raw m', 'pod.material_id = m.id', 'left');
//     $this->db->join('master_unit u', 'pod.unit_id = u.id', 'left');
//     $this->db->join('mfd_stock_details msd', 'pod.material_id = msd.materials', 'left');
//     $this->db->join('daily_mfd_stock dms', 'msd.mfd_stock_id = dms.product_name_id', 'left');

//     // Group by raw_materials, unit_id, unit_name to keep these fields unchanged
//     $this->db->group_by('m.raw_materials, pod.qty, pod.unit_id, u.units, msd.units');

//     // Order by purchase order ID if needed
//     $this->db->order_by('po.id', 'ASC');

//     $query = $this->db->get();
//     return $query->result();
// }


//---------------------

 public function get_purchase_report($filterName = null, $filterInvoiceNo = null, $filterBillDate = null) {
    $this->db->select('
        po.id AS purchase_order_id,
        po.bill_date,
        po.supplier_id,
        s.supp_name AS supplier_name,
        po.payment_mode,
        po.total_amt,
        po.cash_discount,
        po.payable_amt,
        po.paid_amt,
        po.balance_amt,
        po.invoice_no,
        pod.sl_no,
        pod.material_id,
        m.raw_materials AS raw_materials,
        pod.unit_id,
        u.units AS unit_name,
        pod.purchase_price,
        pod.qty AS quantity,
        pod.gross_amt,
        pod.sgst,
        pod.cgst,
        pod.gst_amt,
        pod.line_total
    ');
    $this->db->from('purchase_orders po');
    $this->db->join('purchase_order_details pod', 'po.id = pod.purchase_order_id', 'inner');
    $this->db->join('reg_supplier s', 'po.supplier_id = s.id', 'left');
    $this->db->join('master_raw m', 'pod.material_id = m.id', 'left');
    $this->db->join('master_unit u', 'pod.unit_id = u.id', 'left');
    $this->db->order_by('po.bill_date', 'DESC'); // Sort by bill date, descending
    $this->db->order_by('po.id', 'ASC'); // Then by purchase order id, ascending

    // Apply filters if provided
    if (!empty($filterName)) {
        $this->db->where('s.supp_name', $filterName);
    }
    if (!empty($filterInvoiceNo)) {
        $this->db->where('po.invoice_no', $filterInvoiceNo);
    }
    if (!empty($filterBillDate)) {
        $this->db->where('po.bill_date', $filterBillDate);
    }

    $query = $this->db->get();
    return $query->result();
}

public function get_purchaseSupplier() {
    $query = $this->db->select('supp_name')->distinct()->get('reg_supplier');
    return $query->result_array();
}

//--------------------------

  public function get_mfd_rep($filterName = '', $filterHsnCode = '', $filterDate = '') {
    $this->db->select('
        ms.id AS stock_id,
        ms.product_name,
        ms.hsn_code,
        mp.pieces_pp,                     
        ms.qty_in_kg,
        ms.qty_in_pieces,
        ms.qty_in_packet,
        ms.qty_in_dozens,
        ms.wholesale_price,
        ms.retail_price,
        ms.sgst,
        ms.cgst,
        ms.date,
        GROUP_CONCAT(CONCAT(mr.raw_materials, " | ", msd.quantity, " ", msd.units) SEPARATOR ", ") AS materials_used
    ');
    $this->db->from('mfd_stock ms');
    $this->db->join('master_pieces mp', 'ms.pieces_packet = mp.id', 'left');
    $this->db->join('mfd_stock_details msd', 'ms.id = msd.mfd_stock_id', 'left');
    $this->db->join('master_raw mr', 'msd.materials = mr.id', 'left');
    $this->db->group_by('ms.id'); // Group by stock ID to merge materials
    $this->db->order_by('ms.id', 'ASC');

    // Apply filters if provided
    if (!empty($filterName)) {
        $this->db->where('ms.product_name', $filterName);
    }
    if (!empty($filterHsnCode)) {
        $this->db->where('ms.hsn_code', $filterHsnCode);
    }
    if (!empty($filterDate)) {
        $this->db->where('ms.date', $filterDate);
    }
    $query = $this->db->get();
    return $query->result_array();
}


public function get_mfdStocks() {
    $query = $this->db->select('product_name')->distinct()->get('mfd_stock');
    return $query->result_array();
}

//--------------------------------------

public function get_filtered_sales($filterName, $filterBillNo, $filterBillDate) {
    $this->db->select('product_sales.id,
        mfd_stock.id as product_id,
        mfd_stock.product_name,
        product_sales_details.bill_no,
        product_sales.s_hsn_code,
        product_sales.s_pieces_pkt,
        product_sales.s_pkt_avl,
        product_sales.s_dzn_avl,
        product_sales.s_dozens,
        product_sales.s_price_dzn,
        product_sales.s_price_pkt,
        product_sales.s_gross_amt,
        product_sales.s_gst_amt,
        product_sales.s_line_total,
        product_sales_details.bill_date,
        reg_supplier.supp_name,
        product_sales_details.s_payable_amt,
        product_sales_details.s_paid_amt,
        product_sales_details.s_balance_amt');

    $this->db->from('product_sales');
    $this->db->join('product_sales_details', 'product_sales.product_sale_detail_id = product_sales_details.id', 'left');
    $this->db->join('mfd_stock', 'product_sales.product_name_id = mfd_stock.id', 'left');
    $this->db->join('reg_supplier', 'product_sales_details.s_supplier_id = reg_supplier.id', 'left');

    // Apply filters if provided
    if (!empty($filterName)) {
        $this->db->where('reg_supplier.supp_name', $filterName);
    }
    if (!empty($filterBillNo)) {
        $this->db->where('product_sales_details.bill_no', $filterBillNo);
    }
    if (!empty($filterBillDate)) {
        $this->db->where('product_sales_details.bill_date', $filterBillDate);
    }

    $query = $this->db->get();
    return $query->result_array();
}
  
public function get_suppliers() {
    $query = $this->db->select('supp_name')->distinct()->get('reg_supplier');
    return $query->result_array();
}

//----------------------

public function getAllDailyReport($filterName, $filterDate) {
    $this->db->select('
        mfd_stock.id as product_id,
        mfd_stock.product_name,
        mfd_stock.hsn_code,
        daily_mfd_stock.date,
        daily_mfd_stock.product_name_id,
        SUM(product_sales.s_pkt_avl) as s_pkt_avl,
        SUM(product_sales.s_dzn_avl) as s_dzn_avl,
        product_sales.product_sale_detail_id,
        SUM(master_pieces.pieces_pp) as pieces_pp,  -- Summing pieces_pp
        SUM(daily_mfd_stock.qty_in_kg) as qty_in_kg,
        SUM(daily_mfd_stock.qty_in_pieces) as qty_in_pieces,
        SUM(daily_mfd_stock.qty_in_packet) as qty_in_packet,
        SUM(daily_mfd_stock.qty_in_dozens) as qty_in_dozens,
        mfd_stock.wholesale_price,
        mfd_stock.retail_price,
        -- Subtract only when product_name_id matches product_sale_detail_id
        ABS(
            CASE 
                WHEN daily_mfd_stock.product_name_id = product_sales.product_sale_detail_id 
                THEN SUM(product_sales.s_pkt_avl) - SUM(daily_mfd_stock.qty_in_packet) 
                ELSE daily_mfd_stock.qty_in_packet 
            END
        ) AS remaining_qty_in_packet,
        ABS(
            CASE 
                WHEN daily_mfd_stock.product_name_id = product_sales.product_sale_detail_id 
                THEN SUM(product_sales.s_dzn_avl) - SUM(daily_mfd_stock.qty_in_dozens) 
                ELSE daily_mfd_stock.qty_in_dozens 
            END
        ) AS remaining_qty_in_dozens
    ');
    $this->db->from('daily_mfd_stock');
    $this->db->join('mfd_stock', 'daily_mfd_stock.product_name_id = mfd_stock.id', 'left');
    $this->db->join('master_pieces', 'daily_mfd_stock.pieces_packet = master_pieces.id', 'left');
    $this->db->join('product_sales', 'daily_mfd_stock.id = product_sales.id', 'left'); // Ensure join matches correctly
    $this->db->group_by('daily_mfd_stock.product_name_id'); // Group by product name ID

    // Apply filters if provided
    if (!empty($filterName)) {
        $this->db->where('mfd_stock.product_name', $filterName);
    }
    if (!empty($filterDate)) {
        $this->db->where('daily_mfd_stock.date', $filterDate);
    }

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->result(); // Return data as an array of objects
    }

    return []; // Return an empty array if no data is found
}


public function get_product() {
    $query = $this->db->select('product_name')->distinct()->get('mfd_stock');
    return $query->result_array();
}

// public function getStock() {
//     // Subquery to calculate total_qty
//     $this->db->select('
//         pod.material_id, 
//         SUM(pod.qty) AS total_qty
//     ');
//     $this->db->from('purchase_order_details pod');
//     $this->db->group_by('pod.material_id');
//     $subquery = $this->db->get_compiled_select();

//     // Subquery to calculate the total deduction
//     $this->db->select('
//         msd.materials AS material_id,
//         SUM(msd.quantity * dms.qty_in_kg) AS total_deduction
//     ');
//     $this->db->from('mfd_stock_details msd');
//     $this->db->join('daily_mfd_stock dms', 'msd.mfd_stock_id = dms.product_name_id', 'inner');
//     $this->db->group_by('msd.materials');
//     $deduction_subquery = $this->db->get_compiled_select();

//     // Main query
//     $this->db->select('
//         GROUP_CONCAT(DISTINCT po.id) AS purchase_order_id,
//         pod.material_id,
//         m.raw_materials AS raw_materials,
//         pod.unit_id,
//         u.units AS unit_name,
//         total_qty_subquery.total_qty,
//         GROUP_CONCAT(DISTINCT msd.quantity ORDER BY msd.quantity DESC) AS mfd_quantities,
//         msd.units AS mfd_unit,
//         GROUP_CONCAT(DISTINCT msd.mfd_stock_id ORDER BY msd.mfd_stock_id) AS mfd_stock_ids,
//         GROUP_CONCAT(DISTINCT dms.product_name_id ORDER BY dms.product_name_id) AS product_name_ids,
//         GROUP_CONCAT(DISTINCT dms.qty_in_kg ORDER BY dms.qty_in_kg) AS qty_in_kgs,
//         (total_qty_subquery.total_qty - COALESCE(deduction_subquery.total_deduction, 0)) AS   
//     ');

//     $this->db->from('purchase_orders po');
//     $this->db->join('purchase_order_details pod', 'po.id = pod.purchase_order_id', 'inner');
//     $this->db->join('master_raw m', 'pod.material_id = m.id', 'left');
//     $this->db->join('master_unit u', 'pod.unit_id = u.id', 'left');
//     $this->db->join('mfd_stock_details msd', 'pod.material_id = msd.materials', 'left');
//     $this->db->join('daily_mfd_stock dms', 'msd.mfd_stock_id = dms.product_name_id', 'left');

//     // Join the subqueries
//     $this->db->join("($subquery) AS total_qty_subquery", 'pod.material_id = total_qty_subquery.material_id', 'inner');
//     $this->db->join("($deduction_subquery) AS deduction_subquery", 'pod.material_id = deduction_subquery.material_id', 'left');

//     // Group and order
//     $this->db->group_by('pod.material_id, m.raw_materials, pod.unit_id, u.units');
//     $this->db->order_by('po.id', 'ASC');

//     $query = $this->db->get();
//     return $query->result();
// }


}





