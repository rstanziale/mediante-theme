<form role="search" method="get" action="<?php echo home_url('/'); ?>">
    <div class="input-group">
        <input type="search" class="form-control form-control-sm" placeholder="Ricerca qualcosa..." value="<?php echo get_search_query() ?>" name="s" title="Ricerca" />
        <input type="submit" value="Cerca" class="btn btn-sm btn-primary" />
    </div>
</form>