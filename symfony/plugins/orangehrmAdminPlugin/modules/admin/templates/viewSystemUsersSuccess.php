<?php
/**
 * OrangeHRM Enterprise is a closed sourced comprehensive Human Resource Management (HRM)
 * System that captures all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM Inc is the owner of the patent, copyright, trade secrets, trademarks and any
 * other intellectual property rights which subsist in the Licensed Materials. OrangeHRM Inc
 * is the owner of the media / downloaded OrangeHRM Enterprise software files on which the
 * Licensed Materials are received. Title to the Licensed Materials and media shall remain
 * vested in OrangeHRM Inc. For the avoidance of doubt title and all intellectual property
 * rights to any design, new software, new protocol, new interface, enhancement, update,
 * derivative works, revised screen text or any other items that OrangeHRM Inc creates for
 * Customer shall remain vested in OrangeHRM Inc. Any rights not expressly granted herein are
 * reserved to OrangeHRM Inc.
 *
 * You should have received a copy of the OrangeHRM Enterprise  proprietary license file along
 * with this program; if not, write to the OrangeHRM Inc. 538 Teal Plaza, Secaucus , NJ 0709
 * to get the file.
 *
 */
?>

<?php 
use_javascript(plugin_web_path('orangehrmAdminPlugin', 'js/viewSystemUserSuccess')); 
?>

<div id="systemUser-information" class="box searchForm toggableForm">
    <div class="head">
        <h1><?php echo __("System Users") ?></h1>
    </div>
    
    <?php include_partial('global/form_errors', array('form' => $form)); ?>
    
    <div class="inner">
        <form id="search_form" name="frmUserSearch" method="post" action="<?php echo url_for('admin/viewSystemUsers'); ?>">
            
            <fieldset>
                
                <ol>
                    <?php echo $form->render(); ?>
                </ol>
                
                <input type="hidden" name="pageNo" id="pageNo" value="" />
                <input type="hidden" name="hdnAction" id="hdnAction" value="search" />
                
                <p>
                    <input type="button" class="searchbutton" id="searchBtn" value="<?php echo __("Search") ?>" name="_search" />
                    <input type="button" class="reset" id="resetBtn" value="<?php echo __("Reset") ?>" name="_reset" />
                </p>
                
            </fieldset>
            
        </form>
    </div> <!-- inner -->
    
    <a href="#" class="toggle tiptip" title="<?php echo __(CommonMessages::TOGGABLE_DEFAULT_MESSAGE); ?>">&gt;</a>
    
</div> <!-- end-of-searchProject -->

<div id="customerList">
    <?php include_component('core', 'ohrmList', $parmetersForListCompoment); ?>
</div>

<!-- Confirmation box HTML: Begins -->
<div class="modal hide" id="deleteConfModal">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3><?php echo __('OrangeHRM - Confirmation Required'); ?></h3>
  </div>
  <div class="modal-body">
    <p><?php echo __(CommonMessages::DELETE_CONFIRMATION); ?></p>
  </div>
  <div class="modal-footer">
    <input type="button" class="btn" data-dismiss="modal" id="dialogDeleteBtn" value="<?php echo __('Ok'); ?>" />
    <input type="button" class="btn reset" data-dismiss="modal" value="<?php echo __('Cancel'); ?>" />
  </div>
</div>
<!-- Confirmation box HTML: Ends -->

<script type="text/javascript">
    function submitPage(pageNo) {
        document.frmUserSearch.pageNo.value = pageNo;
        document.frmUserSearch.hdnAction.value = 'paging';
        $('#search_form input.inputFormatHint').val('');
        document.getElementById('search_form').submit();
    }
                
    var addUserUrl          =   '<?php echo url_for('admin/saveSystemUser'); ?>';
    var viewUserUrl          =   '<?php echo url_for('admin/viewSystemUsers'); ?>';
    var lang_typeforhint    =   '<?php echo __("Type for hints") . "..."; ?>';
    var user_ValidEmployee  =   '<?php echo __(ValidationMessages::INVALID); ?>';

</script>