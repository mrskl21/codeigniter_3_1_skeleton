<div class="section-header">
    <h1><?=isset($title['display'])? $title['display']:"";?></h1>
    <div class="section-header-breadcrumb">
        <?php $no=0; foreach ($title['level'] as $t):?>
        <div class="breadcrumb-item">
            <a href="<?=(isset($title['href'][$no]) && $title['href'][$no] != "") ? base_url().$title['href'][$no]:"#";?>"><?=$t;?></a>
        </div>
        <?php $no++;endforeach;?>
    </div>
</div>
