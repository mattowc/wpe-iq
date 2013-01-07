<!-- bottom section start -->
	<?php 
	if(get_option('ptthemes_bottom_options')=='Two Column - Right(one third)')
		{?>
           <div class="bottom">
           		 <div class="bottom_in clear">
           	 
           	 <div class="max_width left">
            	 <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Bottom 2column - Left')){?> <?php } else {?>  <?php }?>
            </div> <!-- three_column #end -->
      
             <div class="min_width right">
            	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Bottom 2column - Right')){?> <?php } else {?>  <?php }?>
            </div> <!-- three_column #end -->
           
        <?php
 		}else if(get_option('ptthemes_bottom_options')=='Two Column - Left(one third)')
		{?>
   		<div class="bottom">
           <div class="bottom_in clear">
        	<div class="min_width left">
            	 <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Bottom 2column - Left')){?> <?php } else {?>  <?php }?>
            </div> <!-- three_column #end -->
            
    	 <div class="max_width right">
            	 <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Bottom 2column - Right')){?> <?php } else {?>  <?php }?>
            </div> <!-- three_column #end -->
          
 		<?php 
		}
		else if(get_option('ptthemes_bottom_options')=='Equal Column')
		{?> 
         <div class="bottom">
              <div class="bottom_in clear">
         		<div class="equal_column left">
            	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Bottom 2column Equal - Left')){?> <?php } else {?>  <?php }?>
                </div> <!-- three_column #end -->
                  
                <div class="equal_column right">
                    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Bottom 2column Equal - Right')){?> <?php } else {?>  <?php }?>
                </div> <!-- three_column #end -->
           
        <?php 			
		}else if(get_option('ptthemes_bottom_options')=='Three Column')
		{?> 
        <div class="bottom">
            <div class="bottom_in">
             	<div class="three_column left">
            	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Bottom 3column - First')){?> <?php } else {?>  <?php }?>
                </div> <!-- three_column #end -->
                 
                <div class="three_column spacer_3col left">
                    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Bottom 3column - Second')){?> <?php } else {?>  <?php }?>
                </div> <!-- three_column #end -->
                
                <div class="three_column right">
                    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Bottom 3column - Third')){?> <?php } else {?>  <?php }?>
                </div> <!-- three_column #end -->
          
		<?php
  		}else if(get_option('ptthemes_bottom_options')=='Fourth Column')
		{?> 
    	 <div class="bottom">
           <div class="bottom_in clear">
             		<div class="foruth_column left">
            	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Bottom 4column - First')){?> <?php } else {?>  <?php }?>
            </div> <!-- three_column #end -->
            
            
            <div class="foruth_column spacer_4col left">
            	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Bottom 4column - Second')){?> <?php } else {?>  <?php }?>
            </div> <!-- three_column #end -->
            
            <div class="foruth_column spacer_4col left">
            	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Bottom 4column - Third')){?> <?php } else {?>  <?php }?>
            </div> <!-- three_column #end -->
            
             <div class="foruth_column right">
            	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Bottom 4column - Fourth')){?> <?php } else {?>  <?php }?>
            </div> <!-- three_column #end -->
         	 
        <?php	
 		}else if(get_option('ptthemes_bottom_options')=='Full Width')
		{?> 
        <div class="bottom">
           <div class="bottom_in clear">
            	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Bottom Full Width')){?>
        		 <?php } else {?>  <?php }?>
         	 
         <?php }?>

 <!-- bottom section #end  -->