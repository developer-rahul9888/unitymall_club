<?php $user = $profile[0];  ?>
 <!-- /.mainbar -->
 <link rel="stylesheet" type="text/css" media="print" href="<?php echo base_url(); ?>assets/css/print.css">
 
  <div class="content">
    <div class="content-container">

<div class="col-sm-12 no-print">
<a class="btn btn-primary flr " href="<?php echo base_url('admin');?>">Back</a>
<a class="btn btn-primary flr" href="javascript:;" onclick="window.print();" style="margin-right:15px;">Print</a>

<h2>Welcome Letter</h2>
 
</div>
<div class="">
<div class="col-md-8 col-md-offset-2 print-div welcome-letter">
<!--<img class="wl-bg-img" src="/assets/images/gnd-letter.png">-->
<table style="position:relative;z-index:5; " cellspacing="2" cellpadding="2" border="0" bgcolor="#FFFFFF">
<tbody>
  <tr>

    <td style="padding:5px">
	<div class="logowlcm">
<img class="img-responsive" src="<?php echo base_url();?>main-admin/images/logo.png">
</div>
	<table  cellspacing="0" cellpadding="0" border="0">

      <tbody style="padding:5px">

        <tr>

          <td class="text-center" style="BORDER-BOTTOM: 1px solid #3999a6;"><h3 style="color:#ac2523;font-size:20px;font-weight:bold;">WELCOME TO Unity Mall </h3></td>

          </tr>

        <tr>

          <td class="text1"><br><p class="txtyellow">To,<br>

                <b><?php echo ucfirst($this->session->userdata('full_name'));?></b>

                <br>

                <strong>User ID:</strong>
                <?php echo $user['customer_id'];?>				
				<br>

                 <strong>Date Of Joining:</strong>

                 <?php echo $user['rdate'];?>
<br>				 
				  <strong>Sponsor  ID:</strong>
                <?php echo $user['parent_customer_id'];?>


                 
                <br>
                <strong>Mobile:</strong>

                <?php echo $user['phone'];?>
               </p>
<p>Dear User,</p>

<p>With all our heartiest congratulations, we welcome you to the family of <strong>Unity Mall</strong>.</p>

<p>This letter confirms you registration to the world of prosperity and squad of team workers. It also offers you unprecedented opportunities, financial securities, source of never ending opportunity and all of things, peace of mind and leisure. Our team will be with you every step of the way to help you on your road to success-ultimate success. Take the best use of our services and plan for a great success and better future of the society.</p>

<p>Hereby we take the liberty of asking you to kindly devote sometime in explaining your team as to how they can make their vision a certainty. For any further information / assistance, please feel free to contact us 24 hours at our email at <strong>info@unitymall.com</strong></p>


<p><strong>Unity Mall</strong> family strive hard to make your dreams a reality and our pledge a truth. We promise you best of services in future and look forward a long lasting and fruitful association with you.</p>

<p>We are here for you......!!</p>
 <p>&nbsp;</p>

<p>Warm Regards,<br>
<strong>Unity Mall </strong></p>

<p>&nbsp;</p>
<p>&nbsp;</p>

</td>

        </tr>

        </tbody>

    </table> </td>

  </tr>

</tbody></table>

</div>
</div>
</div>
</div>