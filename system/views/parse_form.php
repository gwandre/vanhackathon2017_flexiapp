<form action="parse.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="fileToUpload">Select XML/JSON file:</label>
                <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload">
            </div>
            <input type="submit" value="Upload and Parse Files" name="submit">
        </div>
    </div>
</form>