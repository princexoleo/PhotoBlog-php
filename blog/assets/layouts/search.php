<div class="card my-4">
    <h5 class="card-header">Search</h5>
    <div class="card-body">
        <form action="search.php" method="post">
           <div class="form-group">
               <div class="input-group">
                    <input type="text" class="form-control" name="title" value="" placeholder="Search for title">
                     <select class="form-control" name="category">
                         <option value="entertainment">Entertainment</option>
                         <option value="science">Science</option>
                         <option value="sports">Sports</option>
                         <option value="dhaka">Dhaka</option>
                         <option value="mymensingh">Mymensingh</option>
                         <option value="khulna">Khulna</option>
                         <option value="others" selected>Others</option>
                    </select>
                    
                     <span class="input-group-btn">
                          <button class="btn btn-secondary" type="submit">Go!</button>
                     </span>
              </div>
            </div>
        </form>
    </div>
</div>