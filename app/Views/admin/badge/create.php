<div class="row p-0 m-0">
    <form method="POST" action="/admin/badges/store">
    <div class="mb-3">
        <label for="badge_name" class="form-label">Badge Title</label>
        <input type="text" class="form-control" name="title" id="badge_name" placeholder="Ender Badge Title">
    </div>
    <div class="mb-3">
        <label for="badge_type" class="form-label">Badge type</label>
        <input class="form-control" id="badge_type" name="type">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary mb-3">Create badge</button>
    </div>

  </form>
</div>
