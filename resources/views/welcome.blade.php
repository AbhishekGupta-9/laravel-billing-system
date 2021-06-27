<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Billing System</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="_token" content="{{csrf_token()}}" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
      <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script src="https://kit.fontawesome.com/e892e7a8a8.js" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
   </head>
   <body>
      <div class="container">
         <h2>Billed Records</h2>
         <button type="button" class="btn btn-primary" style="float :right !important;margin-top: -30px"data-toggle="modal"data-target="#itemModal">Add Item</button>
         <button type="button" class="btn btn-primary" style="float :right !important;margin-top: -30px"onclick="viewItems()">View Items</button>
         <button type="button" class="btn btn-primary" style="float :right !important;margin-top: -30px"data-toggle="modal"data-target="#customerModal">Add Customer</button>
         <button type="button" class="btn btn-primary" style="float :right !important;margin-top: -30px"onclick="viewCustomers()">View Customers</button>
         <table class="table" id="billing">
            <thead>
               <th>S.No</th>
               <th>Date Time</th>
               <th>Customer Name</th>
               <th>Total Amount</th>
               <th>Action</th>
            </thead>
         </table>
      </div>
      <!-- Add Item Modal -->
      <div class="modal fade" id="itemModal" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add Item</h4>
               </div>
               <div class="modal-body">
                  <form  id="itemForm" name="itemForm" method="post" action="save-item-record">
                     @csrf
                     <div class="form-group">
                        <label for="fname">Item Name:</label>
                        <input type="text" class="form-control" id="item-name" placeholder="Enter Item Name" name="item_name">
                        <span class="label label-danger item_name"></span>
                     </div>
                     <div class="form-group">
                        <label for="lname">Item Price:</label>
                        <input type="text" class="form-control" id="item_price" placeholder="Enter Item Price" name="item_price">
                        <span class="label label-danger item_price"></span>
                     </div>
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-success savebtn" style="float :right !important;margin-right: 13px;">Save</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- View Items Modal -->
      <div class="modal fade" id="viewItemsModal" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">View Items</h4>
               </div>
               <div class="modal-body">
                  <table class="table" id="viewItemsTable">
                     <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Rate</th>
                     </thead>
                  </table>
               </div>
            </div>
         </div>
      </div>
      </div>
      <!-- Add Customer Modal -->
      <div class="modal fade" id="customerModal" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add Customer</h4>
               </div>
               <div class="modal-body">
                  <form  id="customerForm" name="customerForm" method="post" action="save-customer-record">
                     @csrf
                     <div class="form-group">
                        <label for="fname">Customer Name:</label>
                        <input type="text" class="form-control" id="c-name" placeholder="Enter Customer Name" name="cust_name">
                        <span class="label label-danger cust_name"></span>
                     </div>
                     <div class="form-group">
                        <label for="lname">Customer City:</label>
                        <input type="text" class="form-control" id="c_city" placeholder="Enter Customer City" name="cust_city">
                        <span class="label label-danger cust_city"></span>
                     </div>
                     <div class="form-group">
                        <label for="lname">Customer Address:</label>
                        <input type="text" class="form-control" id="c_addr" placeholder="Enter Customer Address" name="cust_addr">
                        <span class="label label-danger cust_addr"></span>
                     </div>
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-success savebtn" style="float :right !important;margin-right: 13px;">Save</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- View Customer Modal -->
      <div class="modal fade" id="viewCustomerModal" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">View Customers</h4>
               </div>
               <div class="modal-body">
                  <table class="table" id="viewCustomersTable">
                     <thead>
                        <th>Cust. ID</th>
                        <th>Name</th>
                        <th>City</th>
                        <th>Address</th>
                     </thead>
                  </table>
               </div>
            </div>
         </div>
      </div>
      </div>
      <br/>
      <!-- Create Bill Form -->
      <div class="container" style="border-style: double;">
         <h2 style="text-align: center;">Create Bill</h2>
         <form id="save-bill"method="post" action="{{ url('create-bill') }}">
            @csrf
            <div>
               <div class="col-lg-6">
                  <b>Date: {{ date('d M, Y') }}</b>
               </div>
               <div class="col-lg-6">
                  <b>Bill No:<span id="bill_no"> {{ \App\BillHeader::count() + 1}}</span></b>
               </div>
               <div class="col-lg-6">
                  <b>Select Customer:</b>
                  <select name="customer"class="select2"onchange="getCustomer()"id="customer_list">
                     <option value="">--Select Customer--</option>
                  </select>
                  &nbsp;<i class="fas fa-plus"data-toggle="modal"data-target="#customerModal"style="cursor: pointer;"></i>
                  <span class="label label-danger customer"></span>
               </div>
               <div class="col-lg-12">
                  <b>City:<span id="city"></span></b>
               </div>
               <div class="col-lg-12">
                  <b>Address:<span id="addr"></span></b>
               </div>
               <table class="table"border="1"cellspacing="0">
                  <thead>
                     <th style="width: 30px;"></th>
                     <th>S.No</th>
                     <th style="width: 30%;">Item</th>
                     <th>Rate</th>
                     <th>Qty</th>
                     <th>Amount</th>
                     <th style="width: 30px;"></th>
                  </thead>
                  <tbody id="item_lists">
                     <td><i class="fas fa-plus addItemRow" style="cursor: pointer;"></i></td>
                     <td class="s_no">1</td>
                     <td>
                        <div class="form-group">
                           <select class="select2 form-control"name="item[]"id="item_0"onchange="getRate(this)"data-id="0">
                              <option value="">--Select Item--</option>
                              @foreach(\App\ItemMaster::latest()->get() as $item)
                              <option value="{{ $item->id }}"rate="{{ $item->rate }}">{{ $item->name }}</option>
                              @endforeach
                           </select>
                           <span class="label label-danger item_0"></span>
                     </td>
                     </div>
                     <div class="form-group">
                        <td>
                           <input class="form-control"readonly="readonly"id="rate_0">
                        </td>
                     </div>
                     <div class="form-group">
                        <td>
                           <input class="form-control quantity"placeholder="Enter Quantity"id="qty_0"name="quantity[]"data-id="0">
                           <span class="label label-danger quantity_0"></span>
                        </td>
                     </div>
                     <td>
                        <div class="form-group amountdiv">
                           <input class="form-control amtPerItem"readonly="readonly"id="amt_0">
                        </div>
                     </td>
                     <td></td>
                  </tbody>
               </table>
               <div class="col-sm-12 col-lg-12">
                  <div class="pull-right">
                     <strong>Total Amount
                     <input type="text" readonly="readonly"id="total_amt"></strong>
                  </div>
               </div>
               <div class="col-lg-12">
                  <div style="text-align: center;">
                     <button type="submit" class="btn btn-primary"style="margin-bottom: 30px;">Save</button>
                  </div>
               </div>
            </div>
         </form>
      </div>
      <br/><br/><br/>
      <!-- View Items Modal -->
      <div class="modal fade" id="viewDetailedBill" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">View Bill Details</h4>
               </div>
               <div class="modal-body">
                  <table class="table" id="detailedBillTable">
                     <thead>
                        <th>Item</th>
                        <th>Rate</th>
                        <th>Quantity</th>
                     </thead>
                  </table>
               </div>
            </div>
         </div>
      </div>
      </div>
      <script type="text/javascript">
      //View All Invoices
    $(document).ready(function(){
        getCustomers();
        $('.select2').select2();
        $('#billing').DataTable({
            serverSide: true,
            "pageLength": 10,
            processing: true,
            responsive: true,
            colReorder: true,
            "order": [],

            ajax:{ url:"{{ url('get-all-bills') }}"},
            columns: [
                { data:'id', name:'id'},
                { data:'date', name:'date'},
                { data:'date', name:'date',render:function (data, type, row, meta ){
                    return row.customer.name;
                }
            },
                { data:'total_amount', name:'total_amount'},
                { data:'action', name:'action'},
                ],
                destroy: true,
                fixedColumns: true
            });
    });
    //Create Item Recird
    $('#itemForm').submit(function(e){
        e.preventDefault();
        var data   = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            method: 'post',
            data: data,
            contentType: false,
            processData: false,
            success: function(result){
                $('.label-danger').text('');
                if(result.success==false){
                    toastr.error(result.msg);
                    $.each(result.error,function(k,v){
                        $('.'+k).text(v[0]);
                    });
                }
                if(result.success == true){
                    $("#itemModal").modal("toggle");
                    toastr.success(result.msg);
                    $('#itemForm').trigger("reset");
                }
                if(result.success_fail == true){
                    toastr.error(result.msg);
                }
            },error:function(result){
                console.log(result);
            }
        });
    });
    //View Items
    function viewItems()
    {
        $('#viewItemsModal').modal('toggle');
        var table = $('#viewItemsTable').DataTable({
            serverSide: true,
            "pageLength": 10,
            processing: true,
            responsive: true,
            colReorder: true,
            "order": [],

            ajax:{ url:"{{ url('view-items') }}"},
            columns: [
                { data:'id', name:'id'},
                { data:'name', name:'name'},
                { data:'rate', name:'rate'}
                ],
                destroy: true,
                fixedColumns: true
            });
    }
    //View Customers
    function viewCustomers()
    {
        $('#viewCustomerModal').modal('toggle');
        var table = $('#viewCustomersTable').DataTable({
            serverSide: true,
            "pageLength": 10,
            processing: true,
            responsive: true,
            colReorder: true,
            "order": [],

            ajax:{ url:"{{ url('view-customers') }}"},
            columns: [
                { data:'id', name:'id'},
                { data:'name', name:'name'},
                { data:'city', name:'city'},
                { data:'address', name:'address'},
                ],
                destroy: true,
                fixedColumns: true
            });
    }
    //Create Customer Record
    $('#customerForm').submit(function(e){
        e.preventDefault();
        var data   = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            method: 'post',
            data: data,
            contentType: false,
            processData: false,
            success: function(result){
                $('.label-danger').text('');
                if(result.success==false){
                    toastr.error(result.msg);
                    $.each(result.error,function(k,v){
                        $('.'+k).text(v[0]);
                    });
                }
                if(result.success == true){
                    $("#customerModal").modal("toggle");
                    toastr.success(result.msg);
                    $('#customerForm').trigger("reset");
                    getCustomers();
                }
                if(result.success_fail == true){
                    toastr.error(result.msg);
                }
            },error:function(result){
                console.log(result);
            }
        });
    });
    //Get All Customers
    function getCustomers()
    {
      $.ajax({
            url: '{{ url('get-all-customers') }}',
            method: 'get',
            success: function(result){
                var options = '<option value="">--Select Customer--</option>';
                $.each(result, function(k, v) {
                    options += '<option data-city="' + v.city + '" data-addr="' + v.address + '" value="' + v.id + '">'+v.name+'</option>';
                });
                $('#customer_list').html(options);
            },error:function(result){
            }
        });
    }
    //Onchage Customer event
    function getCustomer(cust_row)
    {
        $('#city').html($("#customer_list option:selected").attr('data-city'));
        $('#addr').html($("#customer_list option:selected").attr('data-addr'));
    }
    //Add Item addItemRow
    $(document).on('click', '.addItemRow', function() {
	var row_count = $('#item_lists tr').length + 1;
	var tr_count = $('#item_lists tr').length;
	var html = `<tr>
   <td></td>
   <td class="s_no"></td>
   <td>
      <div class="form-group">
         <select class="select2 form-control"name="item[]"id="item_` + tr_count + `"onchange="getRate(this)"data-id="` + tr_count + `">
            <option value="">--Select Item--</option>
            @foreach(\App\ItemMaster::latest()->get() as $item)
            <option value="{{ $item->id }}"rate="{{ $item->rate }}">{{ $item->name }}</option>
            @endforeach
         </select>
         <span class="label label-danger item_` + tr_count + `"></span>
   </td>
   </div>
   <div class="form-group">
      <td>
         <input class="form-control "readonly="readonly"id="rate_` + tr_count + `">
      </td>
   </div>
   <div class="form-group">
      <td>
         <input class="form-control quantity"placeholder="Enter Quantity"id="qty_` + tr_count + `"name="quantity[]"data-id="` + tr_count + `">
         <span class="label label-danger quantity_` + tr_count + `"></span>
      </td>
   </div>
   <td>
      <div class="form-group amountdiv">
         <input class="form-control amtPerItem"readonly="readonly"id="amt_` + tr_count + `">
      </div>
   </td>
   <td>
      <span><a href="#" onclick="removeRow(this)"><span class="badge"><i class="fa fa-times"></i></span></a></span>
   </td>
</tr>`;
$('#item_lists').append($(html).get(0));
$('#item_' + tr_count).select2();
assignSNo();
});

    function removeRow(row) {

        $(row).closest('tr').remove();
            assignSNo();
            getTotalAmount();
        }
        function assignSNo()
        {
        $("#item_lists tr td.s_no").each(function(k , v) {
        $(this).html(k + 1);
});
        }
//Create Bill
        $('#save-bill').submit(function(e){
        e.preventDefault();
        var data   = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            method: 'post',
            data: data,
            contentType: false,
            processData: false,
            success: function(result){
                $('.label-danger').text('');
                if(result.success==false){
                    toastr.error(result.msg);
                    $.each(result.error,function(k,v){
                        $('.'+k).text(v[0]);
                        if(k.includes(".")){
                        $('.'+k.split('.').join('_')).text(v[0]);
                        }
                    });
                }
                if(result.success == true){
                    $('#billing').DataTable().ajax.reload();
                    toastr.success(result.msg);
                    $('#save-bill').trigger("reset");
                    $("#item_lists tr:gt(0)"). remove()
                    getCustomers();
                    $('#city').html('');
                    $('#addr').html('');
                    //Change Bill No
                    $('#bill_no').html('{{ \App\BillHeader::count() + 1}} ');
                }
                if(result.success_fail == true){
                    toastr.error(result.msg);
                }
            },error:function(result){
                console.log(result);
            }
        });
    });
    //Set Rate To input
    function getRate(item) {
	const itemId = $(item).attr('id') + ' option:selected';
	$('#rate_' + $(item).attr('data-id')).val($('#' + itemId).attr('rate'));
	$('#qty_' + $(item).attr('data-id')).val('');
	$('#amt_' + $(item).attr('data-id')).val('');
}
//Quantity keyup event
$(document).on('keyup', '.quantity', function() {
	const rate = $('#rate_' + $(this).attr('data-id')).val();
	const qty = $(this).val();
	$('#amt_' + $(this).attr('data-id')).val(rate * qty);
	getTotalAmount();
});

//Get Total Amoubt
function getTotalAmount() {
	let totalPayableAmount = parseFloat(0);
	$("#item_lists tr td .amountdiv .amtPerItem").each(function() {
		totalPayableAmount += parseFloat($(this).val());
	});
	$('#total_amt').val(totalPayableAmount);
}
//Detailed Bill
$(document).on('click', '.btn_details', function() {
	$('#viewDetailedBill').modal('toggle');
	const billHeaderId = $(this).attr('data-id');
	$('#detailedBillTable').DataTable({
		serverSide: true,
		processing: true,
		responsive: true,
		colReorder: true,
		searchable: 'destroy',
		columnDefs: [{
			orderable: false,
			targets: -1
		}],
		ajax: {
			url: '{{ url('get-detailed-bill') }}',
			data: {
				data: billHeaderId
			}
		},
		columns: [{
				render: function(data, type, row, meta) {
					return row.item.name;
				}
			},
			{
				data: 'rate',
				name: 'rate'
			},
			{
				data: 'qty',
				name: 'qty'
			}
		],
		destroy: true,
		fixedColumns: true,
		order: [],
		//"bFilter": false
	});
});
      </script>
   </body>
</html>
