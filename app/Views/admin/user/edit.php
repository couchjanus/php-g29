<div class="row p-0 m-0">
    <form method="post" action="/admin/users/update">
        <input type="hidden" name="id" value="<?=$user->id?>">
    <div class="mb-3">
        <label for="user_name" class="form-label">User Name</label>
        <input type="text" class="form-control" name="name" id="user_name" value="<?=$user->name?>">
    </div>
    <div class="mb-3">
        <label for="user_email" class="form-label">User Email</label>
        <input type="email" class="form-control" name="email" id="user_email" value="<?=$user->email?>">
    </div>
    <div class="mb-3">
        <label for="role" class="form-label">User Role</label>
        <select class="form-select" id="role" name="role_id">
            <option value="">Choose...</option>
            <?php foreach($roles as $role):?>
                <option value="<?=$role->id?>" <?php echo ($role->id == $user->role_id ? "selected" : "")?>><?=$role->name?></option>
            <?php endforeach?>
        </select>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" name="status" id="status" <?php echo ($user->status == 1)? 'checked': ''?>">
        <label for="status" class="form-check-label"> Check If Active</label>
        
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary mb-3">Update User</button>
    </div>

  </form>
</div>
