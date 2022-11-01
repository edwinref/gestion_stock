
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Modifier les commandes
      
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Commandes</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>


        <div class="box">
          
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('Controller_Orders/create') ?>" method="post" class="form-horizontal">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="date" class="col-sm-12 control-label">Date: <?php echo date('Y-m-d') ?></label>
                </div>
                <div class="form-group">
                  <label for="time" class="col-sm-12 control-label">Date: <?php echo date('h:i a') ?></label>
                </div>

                <div class="col-md-7 col-xs-12 pull pull-left">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Nom du client</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Client Name" value="<?php echo $order_data['order']['customer_name'] ?>" autocomplete="off"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Adresse du client</label>
                    <div class="col-sm-7">
                      <textarea type="text" class="form-control" id="customer_address" name="customer_address" placeholder="Enter Client Address" value="<?php echo $order_data['order']['customer_address'] ?>" autocomplete="off"></textarea> 
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Téléphone du client</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="customer_phone" name="customer_phone" placeholder="Enter Client Phone" value="<?php echo $order_data['order']['customer_phone'] ?>" autocomplete="off">
                    </div>
                  </div>
                </div>
                
                
                <br /> <br/>
                <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="width:50%">Produit</th>
                      <th style="width:10%">Quantité</th>
                      <th style="width:10%">Évaluer</th>
                      <th style="width:20%">Montant</th>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>

                    <?php if(isset($order_data['order_item'])): ?>
                      <?php $x = 1; ?>
                      <?php foreach ($order_data['order_item'] as $key => $val): ?>
                        <?php //print_r($v); ?>
                       <tr id="row_<?php echo $x; ?>">
                         <td>
                          <select class="form-control select_group product" data-row-id="row_<?php echo $x; ?>" id="product_<?php echo $x; ?>" name="product[]" style="width:100%;" onchange="getProductData(<?php echo $x; ?>)" required>
                              <option value=""></option>
                              <?php foreach ($products as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?>" <?php if($val['product_id'] == $v['id']) { echo "selected='selected'"; } ?>><?php echo $v['name'] ?></option>
                              <?php endforeach ?>
                            </select>
                          </td>
                          <td><input type="text" name="qty[]" id="qty_<?php echo $x; ?>" class="form-control" required onkeyup="getTotal(<?php echo $x; ?>)" value="<?php echo $val['qty'] ?>" autocomplete="off"></td>
                          <td>
                            <input type="text" name="rate[]" id="rate_<?php echo $x; ?>" class="form-control"  value="<?php echo $val['rate'] ?>"  disabled autocomplete="off">
                            <input type="hidden" name="rate_value[]" id="rate_value_<?php echo $x; ?>" class="form-control" value="<?php echo $val['rate'] ?>" autocomplete="off">
                          </td>
                          <td>
                            <input type="text" name="amount[]" id="amount_<?php echo $x; ?>" class="form-control" value="<?php echo $val['amount'] ?>" disabled autocomplete="off">
                            <input type="hidden" name="amount_value[]" id="amount_value_<?php echo $x; ?>" class="form-control" value="<?php echo $val['amount'] ?>" autocomplete="off">
                          </td>
                          <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow('<?php echo $x; ?>')"><i class="fa fa-close"></i></button></td>
                       </tr>
                       <?php $x++; ?>
                     <?php endforeach; ?>
                   <?php endif; ?>
                   </tbody>
                </table>

                <br /> <br/>

                <div class="col-md-6 col-xs-12 pull pull-left">


                <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Montant Produit </label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_amount" name="gross_amount"  value="<?php echo $order_data['order']['gross_amount'] ?>" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" value="<?php echo $order_data['order']['gross_amount'] ?>" autocomplete="off">
                    </div>
                  </div>

                <div class="form-group">
                    <label for="decoup" class="col-sm-5 control-label">Découpage</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="decoup" name="decoup" placeholder="Modifier Découpage " onkeyup="subAmount()" value="<?php echo $order_data['order']['decoup'] ?>" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="lers" class="col-sm-5 control-label">Gharghar</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="lers" name="lers" placeholder="Modifier gharghar" onkeyup="subAmount()" value="<?php echo $order_data['order']['lers'] ?>" autocomplete="off">
                    </div>
                  </div>


                 
                  <?php if($is_service_enabled == true): ?>
                  <div class="form-group">
                    <label for="service_charge" class="col-sm-5 control-label"> Charge <?php echo $company_data['service_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="service_charge" name="service_charge"  value="<?php echo $order_data['order']['service_charge'] ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="service_charge_value" name="service_charge_value" value="<?php echo $order_data['order']['service_charge'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <?php endif; ?>
                  <?php if($is_vat_enabled == true): ?>
                  <div class="form-group">
                    <label for="vat_charge" class="col-sm-5 control-label"> TVA <?php echo $company_data['vat_charge_value'] ?> %</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="vat_charge" name="vat_charge"  value="<?php echo $order_data['order']['vat_charge'] ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="vat_charge_value" name="vat_charge_value" value="<?php echo $order_data['order']['vat_charge'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <?php endif; ?>
                  <div class="form-group">
                    <label for="livr" class="col-sm-5 control-label"> Livraison </label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="livr" name="livr" placeholder="Modifier prix de livraison" onkeyup="subAmount()"value="<?php echo $order_data['order']['livr'] ?>" autocomplete="off">
                    </div>

                    <div class="form-group">
                    <label for="avc" class="col-sm-5 control-label"> Avence </label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="avc" name="avc" placeholder="Modifier avence " onkeyup="subAmount()"value="<?php echo $order_data['order']['avc'] ?>" autocomplete="off">
                    </div>

                    <div class="form-group">
                    <label for="res" class="col-sm-5 control-label"> Reste d'avence </label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="res" name="res" placeholder="Modifier  reste d'avence " onkeyup="subAmount()"value="<?php echo $order_data['order']['res'] ?>" autocomplete="off">
                    </div>

                    <div class="form-group">
                    <label for="espes" class="col-sm-5 control-label"> Espéce </label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="espes" name="espes" placeholder="Modifier L'Espéce" onkeyup="subAmount()"value="<?php echo $order_data['order']['espes'] ?>"  autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="chek" class="col-sm-5 control-label">chéque</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="chek" name="chek" placeholder="Modifier chéque" onkeyup="subAmount()"value="<?php echo $order_data['order']['chek'] ?>"  autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="effet" class="col-sm-5 control-label"> Effet </label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="effet" name="effet" placeholder="Modifier l'Effect " onkeyup="subAmount()"value="<?php echo $order_data['order']['effet'] ?>"  autocomplete="off">
                    </div>
                  </div>
 


                  </div>
                  <div class="form-group">
                    <label for="discount" class="col-sm-5 control-label">Remise</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="discount" name="discount" placeholder="Modifier remise" onkeyup="subAmount()" value="<?php echo $order_data['order']['discount'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Total</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" value="<?php echo $order_data['order']['net_amount'] ?>" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" value="<?php echo $order_data['order']['net_amount'] ?>" autocomplete="off">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="paid_status" class="col-sm-5 control-label">Statut payant</label>
                    <div class="col-sm-7">
                      <select type="text" class="form-control" id="paid_status" name="paid_status">
                        <option value="1">Payé</option>
                        <option value="2">Non payé</option>
                      </select>
                    </div>
                  </div>

                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">

                <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">

                <a target="__blank" href="<?php echo base_url() . 'Controller_Orders/printDiv/'.$order_data['order']['id'] ?>" class="btn bg-blue" >Imprimer</a>
                <button type="submit" class="btn btn-primary">Sauvegarder les modifications</button>
                <a href="<?php echo base_url('Controller_Orders/') ?>" class="btn btn-danger">Retour</a>
              </div>
            </form>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";

  // function printOrder(id)
  // {
  //   if(id) {
  //     $.ajax({
  //       url: base_url + 'orders/printDiv/' + id,
  //       type: 'post',
  //       success:function(response) {
  //         var mywindow = window.open('', 'new div', 'height=400,width=600');
  //         // mywindow.document.write('<html><head><title></title>');
  //         // mywindow.document.write('<link rel="stylesheet" href="<?php //echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>" type="text/css" />');
  //         // mywindow.document.write('</head><body >');
  //         mywindow.document.write(response);
  //         // mywindow.document.write('</body></html>');

  //         mywindow.print();
  //         mywindow.close();

  //         return true;
  //       }
  //     });
  //   }
  // }

  $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

    $("#mainOrdersNav").addClass('active');
    $("#manageOrdersNav").addClass('active');
    
    
    // Add new row in the table 
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: base_url + '/Controller_Orders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            

              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.name+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="rate[]" id="rate_'+row_id+'" class="form-control" ><input type="hidden" name="rate_value[]" id="rate_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" ><input type="hidden" name="amount_value[]" id="amount_value_'+row_id+'" class="form-control"></td>'+
                    '<td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);  
              }
              else {
                $("#product_info_table tbody").html(html);
              }

              $(".product").select2();

          }
        });

      return false;
    });

  }); // /document

  function getTotal(row = null) {
    if(row) {
      var total = Number($("#rate_value_"+row).val()) * Number($("#qty_"+row).val());
      total = total.toFixed(2);
      $("#amount_"+row).val(total);
      $("#amount_value_"+row).val(total);
      
      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }

  // get the product information from the server
  function getProductData(row_id)
  {
    var product_id = $("#product_"+row_id).val();    
    if(product_id == "") {
      $("#rate_"+row_id).val("");
      $("#rate_value_"+row_id).val("");

      $("#qty_"+row_id).val("");           

      $("#amount_"+row_id).val("");
      $("#amount_value_"+row_id).val("");

    } else {
      $.ajax({
        url: base_url + 'Controller_Orders/getProductValueById',
        type: 'post',
        data: {product_id : product_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
          
          $("#rate_"+row_id).val(response.price);
          $("#rate_value_"+row_id).val(response.price);

          $("#qty_"+row_id).val(1);
          $("#qty_value_"+row_id).val(1);

          var total = Number(response.price) * 1;
          total = total.toFixed(2);
          $("#amount_"+row_id).val(total);
          $("#amount_value_"+row_id).val(total);
          
          subAmount();
        } // /success
      }); // /ajax function to fetch the product data 
    }
  }

  // calculate the total amount of the order
  function subAmount() {
    var service_charge = <?php echo ($company_data['service_charge_value'] > 0) ? $company_data['service_charge_value']:0; ?>;
    var vat_charge = <?php echo ($company_data['vat_charge_value'] > 0) ? $company_data['vat_charge_value']:0; ?>;
    var decoup;
    var lers;
    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);

    // sub total
    $("#gross_amount").val(totalSubAmount);
    $("#gross_amount_value").val(totalSubAmount);

    // vat
    var vat = (Number($("#gross_amount").val())/100) * vat_charge;
    vat = vat.toFixed(2);
    $("#vat_charge").val(vat);
    $("#vat_charge_value").val(vat);

    // service
    var service = (Number($("#gross_amount").val())/100) * service_charge;
    service = service.toFixed(2);
    $("#service_charge").val(service);
    $("#service_charge_value").val(service);
    
    var decoup = $("#decoup").val();
    var lers = $("#lers").val();
    var livr = $("#livr").val();
    var avc = $("#avc").val();
    var res = $("#res").val();
    var espes = $("#espes").val();
    var chek = $("#	chek").val();
    var effet = $("#	effet").val();



    // total amount
    var totalAmount = (Number(totalSubAmount) + Number(vat) + Number(service) + Number(decoup) + Number(lers) + Number(livr));
    totalAmount = totalAmount.toFixed(2);
    $("#net_amount").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);

    var discount = $("#discount").val();
    if(discount) {
      var grandTotal = Number(totalAmount) - Number(discount);
      grandTotal = grandTotal.toFixed(2);
      $("#net_amount").val(grandTotal);
      $("#net_amount_value").val(grandTotal);
    } else {
      $("#net_amount").val(totalAmount);
      $("#net_amount_value").val(totalAmount);
      
    } // /else discount 

    var paid_amount = Number($("#paid_amount").val());
    if(paid_amount) {
      var net_amount_value = Number($("#net_amount_value").val());
      var remaning = net_amount_value - paid_amount;
      $("#remaining").val(remaning.toFixed(2));
      $("#remaining_value").val(remaning.toFixed(2));
    }

  } // /sub total amount

  function paidAmount() {
    var grandTotal = $("#net_amount_value").val();

    if(grandTotal) {
      var dueAmount = Number($("#net_amount_value").val()) - Number($("#paid_amount").val());
      dueAmount = dueAmount.toFixed(2);
      $("#remaining").val(dueAmount);
      $("#remaining_value").val(dueAmount);
    } // /if
  } // /paid amoutn function

  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }
</script>

<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>