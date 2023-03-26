  <?php
	//flash messages
	if ($this->session->flashdata('flash_message')) {

		if ($this->session->flashdata('flash_message') == 'updated') {

			echo '<div class="alert alert-success">';

			echo '<a class="close" data-dismiss="alert">×</a>';

			echo '<strong>Well done!</strong> Voucher Purchased sucessfully.';

			echo '</div>';
		} else {

			echo '<div class="alert alert-danger">';

			echo '<a class="close" data-dismiss="alert">×</a>';

			echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';

			echo '</div>';
		}
	}
	?>
  <?php
	$vouchers = array();
	$vouchers = array_column($voucher_data, 'image');
	?>

 <?php
      //form data
      $attributes = array('class' => 'form', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open_multipart('admin/voucher/'.$this->uri->segment(3).'', $attributes);
	//  $prod = $extra_all[0];
	
	  
	  
      ?>





  <div class="clearfix"></div>
  <div class="row weekkk carddd">

  	<div class="col-sm-10 col-sm-offset-1 padding-right">
  		<h4 class="centt">Balance Coins =<?php echo $profile[0]['points']; ?></h4>
  		<div class="product-details">
  			<!--product-details-->
  			<div class="col-sm-4">
  				<div class="view-product imgBox" style="position: relative;">

  					<img src="<?php echo 'https://www.unitymall.in/main-admin/assets/images/' . $voucher_data[0]['image']; ?>" alt="" class="img-responsive">
  				</div>

  			</div>


  			<?php echo validation_errors(); ?>
  			<div class="col-sm-8">
  				<div class="product-information">
  					<!--/product-information-->

  					<h3><?php echo $voucher_data[0]['pname']; ?></h3>
  					<!--<p>Pro. ID: #22</p>
								<p><span class="p_d_price"><span> MRP 50</span></span></p>-->
  					<!--<p><span class="dp_price">Worth Rs <?php //echo $voucher_data[0]['price']; ?></span></p>
  					<p><span class="dp_price">Coins: <?php //echo $voucher_data[0]['points']; ?></span></p>-->
  					<p class="qtform">
  					</p>

  						

  						<input type="hidden" name="pname" value="<?php echo $voucher_data[0]['pname']; ?>">
  						<input type="hidden" name="price" value="<?php echo $voucher_data[0]['points']; ?>">

  						<!--<button type="submit" class="btn btn-fefault cart">
  							<i class="fa fa-shopping-cart"></i>Buy Now
  						</button>-->
  					
  					<p></p>
  					<!--<p><b>PV:</b> 3</p>-->
  					<div class="otp">
  						<label>OTP:</label>
  						<input type="number" min="1" name="quantity" value="1" class="form-control qty-no otpp" placeholder="Qty.">
  					</div>
  					<p><b>Availability:</b> In Stock</p>

  					<p><b>Rating:</b><img src="<?php echo base_url(); ?>assets/images/rating.png" alt=""></p>

  				</div>
  				<!--/product-information-->
  			</div>
  		</div>
		
	
		
		<div class="" ng-app="myApp">
   <div  ng-controller="myController">
      <div class="" >
	     <p ng-bind-html="message"></p>
         <div class="table-responsive">
            <table class="table cart-table brand-2">
               <thead>
                  <tr class="thead">
                     <th class="description">Value</th>
                     <!-- <th class="pa hideOnMobile">Offer</th> -->
                     <th class="description">Coin</th>
                     <th class="quantity">Qty</th>
                     <th class="price">Total</th>
                  </tr>
               </thead>
               <tbody>



			   <?php $new_array = array(); if(!empty($st_vouchers)){
				   foreach($st_vouchers as $key=>$value){


             /*if($value[0]==$value[1]) { $offer = 'No offer'; $disc = 0; }
             else {
               $disc=$value[0]-$value[1];
               $offer = round($disc/$value[0]*100).' % OFF';
             }*/

            $disc=$value[1];
             $new_array[] = array(
               'id'=>$key,
               //'offer'=>$offer,
               'saving'=>$disc,
               'cost'=>$value[0],
               'price'=>$value[1],
               'qty'=>1,
             );


				   }
			   }


				  ?>
          <tr class="animate-repeat" ng-repeat="item in inventory | filter:searchText | orderBy:'category' ">
             <td class="description"><center><span>{{ item.cost }}</span></center></td>
             <td class="text-success description">
                <div><center><span>{{ item.saving }}</span></center></div>
             </td>

             <td class="qty-td">
               <button type="button" ng-click="addItem(item)" class="btn btn-outline-secondary fs-14 rounded-0 px-3 py-0">ADD</button>
               <button type="button" ng-click="minusItem(item)" class="btn btn-outline-secondary fs-14 rounded-0 px-3 py-0">Remove</button>
               <input type="hidden" ng-model="item.qty" class="qty">
             </td>
             <td class="price" id="priceHeader"><center><span> {{ getTCost(item) }}</span></center></td>

          </tr>
            <?php if(empty($new_array)) {
               echo '<tr><td colspan="5"><center>No Record Found</center></td></tr>';
            }



               ?>

               </tbody>
            </table>
         </div>
      </div>


	
	<div class="row align-items-center">
   <div class="col-12 col-md-7 col-lg-5 ">
   </div>
   <div class="col-12 col-md-5 col-lg-7 text-right total">Total Coins<span class="priceSemLarge"> {{ getTotal() }}</span></div>
   <div class="col-sm-12 hide">
      <div class="row">
         <div class="col-sm-12 col-md-8 col-lg-6">
            <div class="custom-control custom-checkbox text-left"><input type="checkbox" id="Gyfting" name="GyftingRecipient" class="custom-control-input" value="unchecked"><label class="custom-control-label" for="Gyfting"> I am Gyfting</label></div>
         </div>
      </div>
   </div>
   <div class="col-md-4" ng-show = "IsVisible">
    <input type="text" class="form-control" name="otp" class="form-control" ng-model="otp" placeholder="Enter OTP">
   </div>
   <br>
   <div class="col-md-12">
      <div class="row">

         <div class="col-6 text-right" >
           
           <button  name="submit" type="button"  ng-click="submitForm()" class="btn btn-default orange">Generate Voucher</button>
           <button style="margin-left:15px;"  name="submit" type="button" ng-show = "IsVisible"  ng-click="resendOTP()" class="btn btn-default orange">Resend OTP</button>
           <button style="margin-left:15px;"  name="submit" type="button"  ng-click="clearCart()" class="btn btn-default orange">Clear Cart</button>
		   </div>
       <div class="col-md-4" >
          
           
           
        </div>
      </div>
   </div>
   </form>
   
</div>

	<style>
  		.product-information .form-control.qty-no.otpp {
  			margin-left: 28px;
			width: 41% !important;
  		}

  		.product-information .otp {
  			display: none;
  		}
  	</style>
	
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular-animate.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.7.0/underscore-min.js"></script>
	
	
	
	<script>
angular.module('myApp', ['ngAnimate']);
angular.module('myApp')
.controller('myController', function ($scope,$http,$location,$sce) {


  $scope.inventory = <?php echo json_encode($new_array); ?>;

  $scope.cart = [];

  var findItemById = function(items, id) {
    return _.find(items, function(item) {
      return item.id === id;
    });
  };

  $scope.getCost = function(item) {
    return item.qty * item.price;
  };

  $scope.getTCost = function(itemToAdd) {
    var found = findItemById($scope.cart, itemToAdd.id);
    if (found) {
      return found.qty * found.price+' ( qty '+ found.qty +' ) ';
    } else {
      return 0;
    }
  }

  $scope.getTQty = function(itemToAdd) {
    var found = findItemById($scope.cart, itemToAdd.id);
    if (found) {
      return found.qty;
    } else {
      return 0;
    }
  }

  $scope.addItem = function(itemToAdd) {
    var found = findItemById($scope.cart, itemToAdd.id);
    if (found) {
      found.qty += itemToAdd.qty;
    }
    else {
      $scope.cart.push(angular.copy(itemToAdd));}
  };

  $scope.minusItem = function(itemToRemove) {
    var found = findItemById($scope.cart, itemToRemove.id);
    if (found) {
      found.qty -= itemToRemove.qty;
      if(found.qty==0) {
        var index = $scope.cart.indexOf(itemToRemove);
        $scope.cart.splice(index, 1);
      }
    }


  };

  $scope.getTotal = function() {
    var total =  _.reduce($scope.cart, function(sum, item) {
      return sum + $scope.getCost(item);
    }, 0);
    return total;
  };

  $scope.clearCart = function() {
    $scope.cart.length = 0;
  };

  $scope.removeItem = function(item) {
    var index = $scope.cart.indexOf(item);
    $scope.cart.splice(index, 1);
  };

  $scope.IsVisible = false;
            $scope.ShowHide = function () {
                //If DIV is visible it will be hidden and vice versa.
                $scope.IsVisible = $scope.IsVisible ? false : true;
            }


  $scope.type = 'OTP';
  $scope.otp = '';
  $scope.submitForm = function() {
    $scope.url = $location.absUrl();
        $http({
          method  : 'POST',
          url     : $scope.url,
          data    : {data:$scope.cart,type:$scope.type,otp:$scope.otp},
         })
          .then(function(data) {
            
            $scope.type = 'PAY';
            if (data.data.success) {
              $scope.IsVisible = false;
              $scope.cart.length = 0;
              $scope.message = $sce.trustAsHtml(data.data.success);
              window.location.href = "https://www.unitymall.club/admin/voucher";
            }
            else if (data.data.errors) {
              $scope.message = $sce.trustAsHtml(data.data.errors);
            } else {
              $scope.message = $sce.trustAsHtml(data.data.message);
              $scope.IsVisible = true;
              //$scope.message = data.message;
            }
          }, function errorCallback(response) {
          });
        };


    $scope.resendOTP = function() {
    $scope.url = $location.absUrl();
        $http({
          method  : 'POST',
          url     : $scope.url,
          data    : {data:$scope.cart,type:'OTP',otp:$scope.otp},
         })
          .then(function(data) {
            $scope.IsVisible = true;
            $scope.type = 'PAY';
            if (data.data.errors) {
              $scope.message = $sce.trustAsHtml(data.data.errors);
            } else {
              $scope.message = $sce.trustAsHtml(data.data.message);
            }
          }, function errorCallback(response) {
              ajaxNotification('error', 'Something went wrong.');
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  });
        };


});

</script>
	
	
<!--/product-details-->
  		<div class="category-tab shop-details-tab">
  			<!--category-tab-->
  			<div class="col-sm-12">
  				<ul class="nav nav-tabs">
  					<li class="active"><a href="#details" data-toggle="tab">Details</a></li>
  					<!--		<li><a href="#reviews" data-toggle="tab">Reviews</a></li>  --->
  				</ul>
  			</div>

  			<div class="tab-content">
  				<div class="tab-pane fade  active in" id="details">
  					<div class="col-sm-12">

  						<p><?php echo $voucher_data[0]['description']; ?></p>
  					</div>
  				</div>

  				<div class="tab-pane fade" id="reviews">
  					<div class="col-sm-12">



  						<p><b>Write Your Review</b></p>
  						<div id="review-msg-div"></div>
  						<form class="form" action="" method="post" id="review">
  							<span>
  								<div class="col-sm-6">
  									<input required="" type="text" name="name" placeholder="Your Name">
  								</div>
  								<div class="col-sm-6">
  									<input required="" type="email" name="email" placeholder="Email Address">
  								</div>
  								<input type="hidden" name="pro_id" value="22">
  							</span>
  							<div class="col-sm-12">
  								<textarea required="" name="comment"></textarea>
  							</div>
  							<div class="col-sm-12 text-right">
  								<input type="submit" name="submit" value="Submit" class="btn btn-primary popup-register-button">
  							</div>
  						</form>
  					</div>
  				</div>
  			</div>
  		</div>
  		<!--/category-tab-->



  	</div>
