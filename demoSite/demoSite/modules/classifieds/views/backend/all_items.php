    <script src="<?=get_theme_path()?>/js/plugins/forms/uniform/jquery.uniform.min.js"></script>
    <script src="<?=get_theme_path()?>/js/plugins/forms/validation/jquery.validate.js"></script>
    <script src="<?=get_theme_path()?>/js/plugins/forms/select2/select2.js"></script> 
    <script src="<?=get_theme_path()?>js/plugins/tables/datatables/jquery.dataTables.min.js"></script><!-- Init plugins only for page -->
    <link href="<?=get_theme_path()?>/js/plugins/forms/select2/select2.css" rel="stylesheet" />
    <link href="<?=get_theme_path()?>/js/plugins/tables/datatables/jquery.dataTables.css" rel="stylesheet" />
    <script src="<?=get_theme_path()?>/js/pages/data-tables.js"></script><!-- Init plugins only for page -->
    
    


                    <div class="row-fluid">
                        
                        <div class="span12">
                            
                            <div class="widget">
                                <div class="widget-title">
                                    <div class="icon"><i class="icon20 i-table"></i></div> 
                                    <h4>Categories list</h4>
                                    <a href="#" class="minimize"></a>
                                </div><!-- End .widget-title -->
                            
                                <div class="widget-content">
                                
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-hover" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Parent</th>
                                            <th>Order</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?foreach($items as $item): ?>

                                        <tr>
                                            <td><?=$item->id?></td>
                                            <td><?=$item->name?></td>
                                            <td><?=$item->parent?></td>
                                            <td><a href="<?=base_url()?>ndex.php/admin/module/classifieds/edit_category/<?=$category->id?>"><span class="i-quill-2"></span></a> <a href="/index.php/admin/module/classifieds/delete_category/<?=$category->id?>" onclick="return confirm('Are you sure you want to permanently delete this category? All items linked to this category will remain intact, but will lose connection to this category.')"><span class="i-remove-4"></span></a></td>
                                        </tr>
                                    <?endforeach;?>
                                       
                                    </tbody>
                                </table>
                             </div><!-- End .widget-content -->
                            </div><!-- End .widget -->
                                                
                        </div><!-- End .span12  -->                     
                                            
                    </div><!-- End .row-fluid  -->
