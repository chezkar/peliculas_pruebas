<?php if(isset($error)): ?>
    <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">Ooops!</h4>
        <p>The movie you search, doesn't exits.</p>
        <hr>
        <p class="mb-0">Try again with other.</p>
    </div>
<?php else: ?>
<table class="table">
    <?php for ($i=0; $i<=$num_rows; $i++): ?>        
        <tr class="tr_<?php echo $i; ?>">
        <?php for ($j=1; $j<=3; $j++): ?>
            <?php if(isset($thmls[$k])): ?>
                <td align="center"> 
                    <div class="wrapper">
                        <div class="box"> 
                            <a href="<?= $thmls[$k]->Poster ?>" data-toggle="lightbox" data-title="<?= $thmls[$k]->Title ?>" data-footer=' <a target="_blank" href="">Crear PDF <i class="far fa-file-pdf"></i></a>'> 
                                <img class="img-fluid" src="<?= $thmls[$k]->Poster != 'N/A' ? $thmls[$k]->Poster : $imgEmpty ?>?image=450" alt="<?= $thmls[$k]->Title ?>" width="200">
                            </a>
                            <div class="data">
                                <p><strong><?= $thmls[$k]->Title ?> <?= $thmls[$k]->Year ?></strong></p>
                                <div class="container">
                                    <div class="row">
                                        <p>
                                            <button type="button" class="btn btn-primary add_movie" data-imb="<?= $thmls[$k]->imdbID ?>"><i class="fas fa-plus"></i></button>
                                            <button type="button" class="btn btn-danger delete_movie" data-imb="<?= $thmls[$k]->imdbID ?>"><i class="fas fa-trash-alt"></i></button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            <?php endif ?>
            <?php $k=$k+1; ?>
        <?php endfor ?>
        </tr>
    <?php endfor ?>
</table>

<script>
    $('#content_movies table button.add_movie').click(function(){
        var imbID = $(this).data('imb');
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/film/saveFilm',
            method: 'POST',
            data: { imbID: imbID },
            success: function(msg){
                var bigbox;
                if(msg == 'DP'){
                    bigbox = humane.create({baseCls: 'humane-bigbox', addnCls: 'humane-bigbox-error'});
                    bigbox.log('You have already save this movie').error();
                }else if (msg == 'SC') {
                    bigbox = humane.create({baseCls: 'humane-bigbox', addnCls: 'humane-bigbox-success'});
                    bigbox.log('Successfully save');
                }else{
                    bigbox = humane.create({baseCls: 'humane-bigbox', addnCls: 'humane-bigbox-error'});
                    bigbox.log('Opps! An error has happened');
                }
            }
        })
    })

    $('#content_movies table button.delete_movie').click(function(){
        var imbID = $(this).data('imb');
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/film/deleteFilm',
            method: 'POST',
            data: { imbID: imbID },
            success: function(msg){
                var bigbox;
                if(msg == 'NA'){
                    bigbox = humane.create({baseCls: 'humane-bigbox', addnCls: 'humane-bigbox-info'});
                    bigbox.log('The movie doesnt exits').error();
                }else if (msg == 'SC') {
                    bigbox = humane.create({baseCls: 'humane-bigbox', addnCls: 'humane-bigbox-success'});
                    bigbox.log('Successfully delete');
                }else{
                    bigbox = humane.create({baseCls: 'humane-bigbox', addnCls: 'humane-bigbox-error'});
                    bigbox.log('Opps! An error has happened');
                }
            }
        })
    })
</script>
<?php endif ?>