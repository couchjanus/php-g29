<div class="row p-0 m-0">
    <form method="post" action="/admin/products/store" enctype="multipart/form-data">
    <div class="row mb-3">
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="name" placeholder="Ender Product Name">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" class="form-control" id="product_price" name="price" placeholder="Ender Product Price">
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="product_description" class="form-label">Product description</label>
        <textarea class="form-control" id="product_description" rows="3" name="description"></textarea>
    </div>

    <div class="row mb-3">
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="product_brand" class="form-label">Products Brand</label>
                <select class="form-select" id="brand" required name="brand_id">
                    <option value="">Choose...</option>
                    <?php foreach($brands as $brand):?>
                        <option value="<?=$brand->id?>"><?=$brand->name?></option>
                    <?php endforeach?>
                </select>
                
            </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="cat" class="form-label">Products Category</label>
                <select class="form-select" id="cat" required name="category_id">
                    <option value="">Choose...</option>
                    <?php foreach($categories as $category):?>
                        <option value="<?=$category->id?>"><?=$category->name?></option>
                    <?php endforeach?>
                </select>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="badge" class="form-label">Products Badge</label>
                <select class="form-select" id="badge" required name="badge_id">
                    <option value="">Choose...</option>
                    <?php foreach($badges as $badge):?>
                        <option value="<?=$badge->id?>"><?=$badge->title?></option>
                    <?php endforeach?>
                </select>
                
            </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3">
                <input type="checkbox" class="form-check-input" id="status" name="status"
                <label for="status" class="form-check-label"> Active</label>
                
            </div>
        </div>
    </div>
   
    <div class="input-group mb-3">
        <input type="file" name="image" class="form-control" id="cover">
        <label for="cover" class="input-group-text">Choose a file</label>
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary mb-3">Create Product</button>
    </div>

  </form>
</div>
