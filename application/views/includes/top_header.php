             <div class="header_top-box">
                    <div class="header-top-left">
                        <div class="box">
                            <select tabindex="4" class="dropdown drop">
                                <option value="" class="label" value="">Dollar :</option>
                                <option value="1">Dollar</option>
                                <option value="2">Euro</option>
                            </select>
                        </div>
                        <div class="box1">
                            <select tabindex="4" class="dropdown">
                                <option value="" class="label" value="">English :</option>
                                <option value="1">English</option>
                                <option value="2">French</option>
                                <option value="3">German</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="cssmenu">
                        <ul>
                            <li class="active"><a href="<?php echo base_url();?>">Home</a></li>
                            <li class="active"><a href="<?php echo base_url();?>cart_view">Cart</a></li> 
                            <li><a href="<?php echo base_url();?>wishlist">Wishlist</a></li> 
                             <?php if(isset($_SESSION['customer_id'])) { ?>
                            <li><a href="<?php echo base_url();?>user_logout">Log Out</a></li> 
                            <?php } else { ?>
                                <li><a href="<?php echo base_url();?>login">Log In</a></li> 
                            <?php } ?>
                                
                            <li><a href="<?php echo base_url();?>register">Sign Up</a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
