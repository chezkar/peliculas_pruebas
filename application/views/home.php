<div class="row">
    <div class="input-group mb-3">
        <button class="btn btn-outline-secondary" type="button" id="search_movie">Search</button>
        <input id="movie_name" type="text" class="form-control" placeholder="Type to search your favorite movie" aria-label="Example text with button addon" aria-describedby="button-addon1">
    </div>
</div>
<div class="row">
    <div id="content_movies" class="table-responsive">

    </div>
</div>

<script>
    $(document).ready(function() {
        $('#search_movie').on('click', function() {
            var words = $('#movie_name').val();
            if (words != '') {
                $.ajax({
                    url: '<?php echo base_url(); ?>index.php/film/seachFilm',
                    method: 'POST',
                    data: { txt: words },
                    cache: false,
                    success: function(pg) {
                        $('#content_movies').html(pg);
                    }
                })
            }
        })
    });
</script>

