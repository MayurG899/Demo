<link href="<?=base_url('/builderengine/public/editor/css/special.css')?>" rel="stylesheet" type="text/css" />
<style>
.orange-subcategory
{
  background-color: rgb(234,168,36)
}
.add_to_cart
{
    display: none;
}
</style>
<div id="wrapper">
    <section class="container">
        <div class="row">
            <div class="col-md-9">
                <h1 style="margin-left: 1%">
                  <?=$title?>
                </h1>
                <div id="shop">
                    <div class="row">
                        <?=$products?>
                    </div>
                    <div class="row">
                        <?=$pagination;?>
                    </div>
                </div>
            </div>
            <aside class="col-md-3">
                <?=$categories_sidebar;?>
                <?=$sorting;?>
            </aside>
        </div>
    </section>
</div>