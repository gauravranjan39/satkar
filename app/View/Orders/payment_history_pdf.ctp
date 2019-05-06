<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}
* {
  box-sizing: border-box;
}

.main {
  float:left;
  width:40%;
  padding:0 20px;
  border: 1px solid goldenrod;
}
.right {
  
  float:left;
  width:50%;
  padding:0 6px;
  /* padding:15px; */
  margin-left:17px;
  /* text-align:center; */
  border: 1px solid goldenrod;
}

}
</style>

</head>
<body>
<div class ="col-md-12"><?php echo $this->Html->image('logo-xx.png',array('height'=>'60','width'=>'70','class'=>'logo-img','style'=>'margin-left:42%;')) ?></div>
<br/><br/>

	<div style="overflow:auto">
		<div class="main">
			<h2>SATKAR JEWELLERS</h2>
			<p>Purani bazar, sabji mandi, opp. of central bank of india</p>
			Mb: +91-9934669155<br/><br/>
		</div>

		<div class="right">
		Customer Details:
			<h2>JAWAHAR LAL NEHRU</h2>
			<p>Purani bazar, sabji mandi, opp. of central bank of india</p>
			Mb: +91-862188272
		</div>
	</div>

	<br/><br/>

                        <table class="table">
                    <thead>
                        <tr>
                            <th>Invoice ID</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                        <tbody class="no-border-x">
                            <?php foreach ($paymentLists as $orderTransaction) { ?>
                            <tr>
                                <td><?php echo $orderTransaction['OrderTransaction']['invoice_number']; ?></td>
                                <td>&#8377;<?php echo number_format($orderTransaction['OrderTransaction']['amount_paid'],2); ?></td>
                                <td><?php echo date('d-M-Y h:i A', strtotime($orderTransaction['OrderTransaction']['created'])); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                           

</section><!-- #content end -->
</body>
</html>