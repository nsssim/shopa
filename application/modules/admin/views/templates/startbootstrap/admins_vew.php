
	<?php
	// load the url helper for base_url 
	$this->load->helper('url');
	$template_path= base_url()."assets/templates/adminlte/";
	 ?>  

      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Admins
            <small>AmerikaShop</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Administrators - Group Privileges & Accounts </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         <button id="new_admin_btn" class="btn btn-success " type="button" data-popup-open="add_new_admin_grp">Add new Admin Group</button>
         <button id="update_permissions_btn" class="btn btn-warning " type="button" >Saving ...</button>
         
         <!----------------------------------admin groups----------------------------------->
	        <div class="row">
	            <!-- Left col -->
	            <div class="col-md-12">
	              <!-- TABLE: Groups & Privileges -->
	              	<div class="box box-info">
		                <div class="box-header with-border">
		                  <h3 class="box-title">Group Privileges</h3>
		                  <div class="box-tools pull-right">
		                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
		                  </div>
		                </div><!-- /.box-header -->
		                
		                <div class="box-body">
		                  	<div class="table-responsive">
		                    	<table class="table no-margin">
				                    <thead>
					                    <tr>
							                <!--<th>ID</th>-->
						                    <th>Name</th>
						                    <th title="Dashboard priviledge (yes/no)" >Dashboard </th>
						                    <th title="Orders priviledge (yes/no)" >Orders  </th>
						                    <th title="Orders priviledge (yes/no)" >Audit-trail  </th>
						                    <th title="Customers priviledge (yes/no)" >Customers </th>
						                    <th title="Price Rules priviledge (yes/no)" >Price Rules </th>
						                    <th title="eProcessors priviledge (yes/no)" >eProcessors </th>
						                    <th title="Admins priviledge (yes/no)" >Admins </th>
						                    <th title="Lists priviledge (yes/no)" >Lists </th>
						                    <th title="Categories priviledge (yes/no)" >Categories </th>
						                    <th title="Emails (yes/no)" >Emails </th>
						                    <th title="Action" >Action </th>
						                    <!--<th class="pull-right"> Status</th>-->
					                    </tr>
				                    </thead>
			                        <tbody>
					                    <?php foreach ($admin_groups as $group) :?>
					                    <tr id="grp_rw_<?php echo $group->id;?>" >
					                        <!--<td  class="grp_id" ><?php echo $group->id;?>  </td>-->
					                        <td><?php echo $group->name;?>  </td>
					                        <td  > <input	class="grp_chkbox " id="dsbrd_chkbox-<?php echo $group->id;?>" 		type="checkbox"  <?php ($group->dashboard)?   $is_chkd='checked=""':$is_chkd=''; echo($is_chkd)?> > </td>
					                        <td  > <input	class="grp_chkbox " id="order_chkbox-<?php echo $group->id;?>" 		type="checkbox"  <?php ($group->order)?	      $is_chkd='checked=""':$is_chkd=''; echo($is_chkd)?> > </td>
					                        <td  > <input	class="grp_chkbox " id="wwwen_chkbox-<?php echo $group->id;?>" 		type="checkbox"  <?php ($group->whowhatwhen)? $is_chkd='checked=""':$is_chkd=''; echo($is_chkd)?> > </td>
					                        <td  > <input	class="grp_chkbox " id="cstmr_chkbox-<?php echo $group->id;?>" 		type="checkbox"  <?php ($group->customers)?   $is_chkd='checked=""':$is_chkd=''; echo($is_chkd)?> > </td>
					                        <td  > <input	class="grp_chkbox " id="prule_chkbox-<?php echo $group->id;?>" 		type="checkbox"  <?php ($group->price_rules)? $is_chkd='checked=""':$is_chkd=''; echo($is_chkd)?> > </td>
					                        <td  > <input	class="grp_chkbox " id="eproc_chkbox-<?php echo $group->id;?>" 		type="checkbox"  <?php ($group->eprocessors)? $is_chkd='checked=""':$is_chkd=''; echo($is_chkd)?> > </td>
					                        <td  > <?php if($group->id != 1): ?> <input	class="grp_chkbox " id="admin_chkbox-<?php echo $group->id;?>" 		type="checkbox"  <?php ($group->Admins)? 	  $is_chkd='checked=""':$is_chkd=''; echo($is_chkd)?> > <?php endif; ?> </td>
					                        <td  > <input	class="grp_chkbox " id="lists_chkbox-<?php echo $group->id;?>" 		type="checkbox"  <?php ($group->lists)? 	  $is_chkd='checked=""':$is_chkd=''; echo($is_chkd)?> > </td>
					                        <td  > <input	class="grp_chkbox " id="categ_chkbox-<?php echo $group->id;?>" 		type="checkbox"  <?php ($group->categories)?  $is_chkd='checked=""':$is_chkd=''; echo($is_chkd)?> > </td>
					                        <td  > <input	class="grp_chkbox " id="email_chkbox-<?php echo $group->id;?>" 		type="checkbox"  <?php ($group->emails)?  	  $is_chkd='checked=""':$is_chkd=''; echo($is_chkd)?> > </td>
					                        <td  > <?php if($group->id != 1): ?> <button  class="btn btn-warning detete_admin_grp" id="del_adm_btn_<?php echo $group->id;?>"  type="button" >delete</button> <?php endif; ?> </td>
				                        </tr>
				                        
				                      	<?php endforeach;?>
				                      
				                      	<!--  <tr>
				                          <td><span class="label label-success">Shipped</span></td>
										  <td><span class="label label-warning">Pending</span></td>
				                          <td><span class="label label-danger">Delivered</span></td>
				                          <td><span class="label label-info">Processing</span></td>
				                        </tr>
				                       	-->
			                        </tbody>
		                    	</table>
		                  	</div><!-- /.table-responsive -->
		                </div><!-- /.box-body -->
		                
		                <div class="box-footer clearfix">
		                 <!-- <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
		                </div><!-- /.box-footer -->
	              	</div><!-- /.box -->
	            </div><!-- /.col -->
	        </div><!-- /.row -->
	        <!----------------------------------end admin groups----------------------------------->

        	<button id="new_admin_btn" class="btn btn-success " type="button" data-popup-open="add_new_admin">Add new Admin</button>

        	<!------------------------------admin accounts--------------------------------------------->

	        <div class="row">
	            <!-- Left col -->
	            &nbsp;
	              <!-- TABLE: Administrators Privileges -->
	              	<div class="box box-info">
		                <div class="box-header with-border">
		                  <h3 class="box-title">Administrators</h3>
		                  <div class="box-tools pull-right">
		                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		                    <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
		                  </div>
		                </div><!-- /.box-header -->
		                
		                <div class="box-body">
		                  	<div class="table-responsive">
		                    	<table class="table no-margin">
				                    <thead>
					                    <tr>
							                <th>ID</th>
						                    <th width="15%">Email</th>
						                    <th>Name</th>
						                    <th>Amin Group</th>
						                    <th>Action</th>
						                    
						                    <!--<th class="pull-right"> Status</th>-->
					                    </tr>
				                    </thead>
			                        <tbody>
					                    <?php foreach ($admins_list as $admin) :?>
					                    <tr>
					                        <td><?php echo $admin->id;?>  </td>
					                        <td id="admin_email_<?php echo $admin->id;?>" ><?php echo $admin->email;?>  </td>
					                        <td><?php echo $admin->first_name;?>  </td>
					                        <td><?php echo $admin->admin_group;?> </td>
					                        <td>
					                        	<button title="Remove Admin Privileges" class="btn btn-warning del_administrator_btn" id="del_administrator_btn_<?php echo $admin->id;?>"  type="button" >Demote</button>
					                        	<button title="Edit Admin Privileges" class="btn btn-warning edt_administrator_btn" id="edt_administrator_btn_<?php echo $admin->id;?>"  type="button" data-popup-open="edit_admin" >Edit</button>
					                        </td>
				                        </tr>

				                      	<?php endforeach;?>
				                      
				                      	<!--  <tr>
				                          <td><span class="label label-success">Shipped</span></td>
										  <td><span class="label label-warning">Pending</span></td>
				                          <td><span class="label label-danger">Delivered</span></td>
				                          <td><span class="label label-info">Processing</span></td>
				                        </tr>
				                       	-->
			                        </tbody>
		                    	</table>
		                  	</div><!-- /.table-responsive -->
		                  	
		                </div><!-- /.box-body -->


        
		                  	
		                
		                <div class="box-footer clearfix">
		                 <!-- <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>-->
		                </div><!-- /.box-footer -->
	              	</div><!-- /.box -->
	            </div><!-- /.col -->
	        </div><!-- /.row -->
	        <!------------------------------------------------------------------------------------->
	       	
	       	
        
         <!---------------------------------pop up add group div here---------------------------------------------------->
		<div class="popup" data-popup="add_new_admin_grp">
		    <div class="popup-inner" style=" max-width: 350px;>
		    	
		    	<form id="add_new_admin_group" >
		    				    	
			    	<table>
			    	 <tr>
					    <td><label for="groupname"> Group Name<span class="required" > *</span> </label></td>
					    <td>
					    	<input id="groupname" class="form-control input-md" type="text" placeholder="group name" value="" name="groupname" required="">
					    </td>
					  </tr>
					  
					  <tr>
					    <td>  </td>
					    <td>
							<button id="add_new_admin_btn" class="btn btn-success " type="button" >Add</button>  
					    </td>
					  </tr>
					  
					   
			    	
			    		
			    	</table>
				</form>
		
		    	
		    <a class="popup-close" data-popup-close="add_new_admin_grp" href="#">x</a>
			</div> <!--end popup-inner-->
		</div>	<!--end popup-->
		<!---------------------------------End pop up add group div here---------------------------------------------------->
        
        
        
	    <!---------------------------------pop up add Admin div here---------------------------------------------------->
		<div class="popup" data-popup="add_new_admin">
		    <div class="popup-inner" style=" max-width: 350px; ">
		    	
		    	<form id="add_new_shipping_address_form">
			    	<table>
			    	 <tr>
					    <td><label for="email"> email<span class="required" > *</span> </label></td>
					    <td>
					    	<input id="popup_email" class="form-control input-md" type="email" placeholder="email" value="" name="popup" required="">
					    </td>
					  </tr>
					  
					  <tr>
							<td><label for="group"> group <span class="required" > *</span> </label></td>
							    <td>
							    	<select id="popup_group" class="form-control input-md" name="group" required="">
										<option value="">Group...</option>
										<?php foreach ($admin_groups as $group) : ?>
										<option value="<?php echo $group->id; ?>"><?php echo $group->name; ?></option>
										<?php endforeach; ?>
									</select>
							</td>
					  </tr>
					  
			    	</table>
				</form>
				<div class="row">
				  <div class="col-md-4"> &nbsp; </div>
				  <div class="col-md-4"> &nbsp; </div>
				  <div class="col-md-4"><button id="add_new_admin_popup_btn" class="btn btn-success " style="margin-top: 40px;padding-right: 5px;" type="button" >Add Admin</button>     </div>
				</div>
		    	
		    <a class="popup-close" data-popup-close="add_new_admin" href="#">x</a>
			</div> <!--end popup-inner-->
		</div>	<!--end popup-->
		<!---------------------------------End pop up add Admin div here---------------------------------------------------->		        
        
        
        <!---------------------------------pop up edit Admin div here---------------------------------------------------->
		<div class="popup" data-popup="edit_admin">
		    <div class="popup-inner" style=" max-width: 350px; ">
		    	
		    	<form id="edit_admin">
			    	<table>
			    	 <tr>
					    <td><label for="email"> email<span class="required" > *</span> </label></td>
					    <td>
					    	<input id="popup_email_edit" class="form-control input-md" type="email" placeholder="email" value="" name="popup" required="">
					    </td>
					  </tr>
					  
					  <tr>
							<td><label for="group"> group <span class="required" > *</span> </label></td>
							    <td>
							    	<select id="popup_group_update" class="form-control input-md" name="group" required="">
										<option value="">Group...</option>
										<?php foreach ($admin_groups as $group) : ?>
										<option value="<?php echo $group->id; ?>"><?php echo $group->name; ?></option>
										<?php endforeach; ?>
									</select>
							</td>
					  </tr>
					  
			    	</table>
				</form>
				<div class="row">
				  <div class="col-md-4"> &nbsp; </div>
				  <div class="col-md-4"> &nbsp; </div>
				  <div class="col-md-4"><button id="update_admin_popup_btn" class="btn btn-success " style="margin-top: 40px;padding-right: 5px; type="button" >Update Admin</button>     </div>
				</div>
		    	
		    <a class="popup-close" data-popup-close="edit_admin" href="#">x</a>
			</div> <!--end popup-inner-->
		</div>	<!--end popup-->
		<!---------------------------------End pop up add Admin div here---------------------------------------------------->		
        
        
        
        
        <!--
        <pre>
        $admins_list ~~~~>admins_vew:line 98
        <?php var_dump($admins_list); ?> 
        </pre>
        -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      

 