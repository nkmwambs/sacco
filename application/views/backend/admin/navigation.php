<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="uploads/logo.png"  style="max-height:60px;"/>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>

    <div style=""></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
		

        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>

        <!-- MEMBER -->
        <li class="<?php
        if ($page_name == 'member_add' ||
                $page_name == 'member_bulk_add' ||
                $page_name == 'members_information')
            echo 'opened active has-sub';
        ?> ">
            <a href="#">
                <i class="fa fa-group"></i>
                <span><?php echo get_phrase('members'); ?></span>
            </a>
            <ul>
                <!-- STUDENT ADMISSION -->
                <li class="<?php if ($page_name == 'student_add') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/member_add">
                        <span><i class="entypo-bookmark"></i> <?php echo get_phrase('admit_member'); ?></span>
                    </a>
                </li>

                <!-- STUDENT BULK ADMISSION -->
                <li class="<?php if ($page_name == 'student_bulk_add') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/member_bulk_add">
                        <span><i class="entypo-bucket"></i> <?php echo get_phrase('admit_bulk_member'); ?></span>
                    </a>
                </li>

                <!-- STUDENT INFORMATION -->
                <li class="<?php if ($page_name == 'members_information') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/member">
                        <span><i class="entypo-info"></i> <?php echo get_phrase('student_information'); ?></span>
                    </a>

                </li>

            </ul>
        </li>

        <!-- DEPARTMENT -->
        <!--<li class="<?php if ($page_name == 'departments') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/departments">
                <i class="entypo-vcard"></i>
                <span><?php echo get_phrase('departments'); ?></span>
            </a>
        </li>-->
      
        <!-- SHARES -->
        <!--<li class="<?php if ($page_name == 'shares') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/share">
                <i class="entypo-share"></i>
                <span><?php echo get_phrase('shares'); ?></span>
            </a>
        </li>-->
        
        <!-- loans -->
        <li class="<?php if ($page_name == 'loans'
        					||$page_name=='extra_payments'
        					||$page_name=='payment_schedule'
        					//||$page_name=='apply_loan'
							//||$page_name=='loan_types'
							) 
							echo 'opened active has-sub'; ?> ">
                        <a href="#">
                <i class="entypo-loop"></i>
                <span><?php echo get_phrase('loans_and_shares'); ?></span>
            </a>
            <ul>
           		 <!-- PROCESS LOAN -->
                <li class="<?php if ($page_name == 'process_loan') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/loans">
                        <span><i class="entypo-clock"></i> <?php echo get_phrase('process_loan'); ?></span>
                    </a>
                </li>
                
                <!-- Apply loan -->
                
               <!-- <li class="<?php if ($page_name == 'apply_loan') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/apply_loan">
                        <span><i class="fa fa-pencil"></i> <?php echo get_phrase('apply_loan'); ?></span>
                    </a>
                </li>    -->            
                
           		 <!-- PROCESS EXTRA REPAYMENTS -->
                <li class="<?php if ($page_name == 'extra_loan_payments') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/extra_payments">
                        <span><i class="entypo-paypal"></i> <?php echo get_phrase('extra_loan_payments'); ?></span>
                    </a>
                </li>                

                <!-- DOWNLOADS REPAYMENTS-->
                <li class="<?php if ($page_name == 'payment_schedule') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/schedule">
                        <span><i class="entypo-export"></i> <?php echo get_phrase('payment_schedule'); ?></span>
                    </a>
                </li>
                
                <!-- Approve REPAYMENTS-->
               <!--<li class="<?php if ($page_name == 'loan_types') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/loan_types">
                        <span><i class="entypo-target"></i> <?php echo get_phrase('loan_types'); ?></span>
                    </a>
               </li>-->

            </ul>
        </li>
        
        <!-- Transactions -->
        
        <li class="<?php if ($page_name == 'transactions') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/transactions">
                <i class="fa fa-money"></i>
                <span><?php echo get_phrase('transactions'); ?></span>
            </a>
        </li>


		<!-- REPORTS -->

        <li class="<?php if ($page_name == 'shares_report'
        					||$page_name=='loans_report'
        					||$page_name=='guarantors_report'
							||$page_name=='interest_report') echo 'opened active has-sub'; ?> ">
                        <a href="#">
                <i class="entypo-list"></i>
                <span><?php echo get_phrase('reports'); ?></span>
            </a>
            <ul>
           		 <!-- SHARES REPORT -->
                <li class="<?php if ($page_name == 'shares_report') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/shares_report">
                        <span><i class="entypo-share"></i> <?php echo get_phrase('shares_report'); ?></span>
                    </a>
                </li>
                
           		 <!-- LOANS REPORT -->
                <li class="<?php if ($page_name == 'loans_report') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/loans_report">
                        <span><i class="entypo-rocket"></i> <?php echo get_phrase('loans_report'); ?></span>
                    </a>
                </li>                

                <!-- GUARANTORS REPORT-->
                <li class="<?php if ($page_name == 'guarantors_report') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/guarantors_report">
                        <span><i class="entypo-help"></i> <?php echo get_phrase('guarantors_report'); ?></span>
                    </a>
                </li>
                
                <!-- INTEREST REPORT-->
               <li class="<?php if ($page_name == 'interest_report') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/interest_report">
                        <span><i class="entypo-inbox"></i> <?php echo get_phrase('interest_report'); ?></span>
                    </a>
               </li>

            </ul>
        </li>
      
        <!-- NOTICEBOARD -->
        <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/noticeboard">
                <i class="entypo-doc-text-inv"></i>
                <span><?php echo get_phrase('noticeboard'); ?></span>
            </a>
        </li>

        <!-- MESSAGE -->
        <li class="<?php if ($page_name == 'message') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/message">
                <i class="entypo-mail"></i>
                <span><?php echo get_phrase('message'); ?></span>
            </a>
        </li>

        <!-- SETTINGS -->
        <li class="<?php
        if ($page_name == 'system_settings' ||
                $page_name == 'manage_language' ||
                    $page_name == 'sms_settings'||
                    $page_name == 'loans_settings'||
                    $page_name == 'departments'||
					$page_name == 'email_tempalates'||
					$page_name == 'additional_fields'||
					$page_name == 'system_reset')
                        echo 'opened active';
        ?> ">
            <a href="#">
                <i class="fa fa-cogs"></i>
                <span><?php echo get_phrase('settings'); ?></span>
            </a>
            <ul>
                <li class="<?php if ($page_name == 'system_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/system_settings">
                        <span><i class="entypo-cog"></i> <?php echo get_phrase('general_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'sms_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/sms_settings">
                        <span><i class="entypo-mobile"></i> <?php echo get_phrase('sms_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'manage_language') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/manage_language">
                        <span><i class="entypo-language"></i> <?php echo get_phrase('language_settings'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'loans_settings') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/loans_settings">
                        <span><i class="entypo-briefcase"></i> <?php echo get_phrase('loans_settings'); ?></span>
                    </a>
                </li> 
                <li class="<?php if ($page_name == 'departments') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/departments">
                        <span><i class="entypo-vcard"></i> <?php echo get_phrase('departments'); ?></span>
                    </a>
                </li>    
                <li class="<?php if ($page_name == 'email_templates') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/email_templates">
                        <span><i class="entypo-mail"></i> <?php echo get_phrase('email_templates'); ?></span>
                    </a>
                </li>
                <li class="<?php if ($page_name == 'additional_fields') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/additional_fields">
                        <span><i class="entypo-users"></i> <?php echo get_phrase('additional_fields'); ?></span>
                    </a>
                </li>                    
                <li class="<?php if ($page_name == 'system_reset') echo 'active'; ?> ">
                    <a href="<?php echo base_url(); ?>index.php?admin/system_reset">
                        <span><i class="entypo-back-in-time"></i> <?php echo get_phrase('system_reset'); ?></span>
                    </a>
                </li>                       
            </ul>
        </li>
        
        <!-- Activity -->
        
        <li class="<?php if ($page_name == 'activity') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/activity">
                <i class="fa fa-list"></i>
                <span><?php echo get_phrase('activity'); ?></span>
            </a>
        </li>        

        <!-- ACCOUNT -->
        <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?admin/manage_profile">
                <i class="entypo-lock"></i>
                <span><?php echo get_phrase('account'); ?></span>
            </a>
        </li>

    </ul>

</div>