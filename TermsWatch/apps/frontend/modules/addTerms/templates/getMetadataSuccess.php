<form action=<?php echo url_for('addTerms/submitPolicy');?> method="post" name="metadataForm" id="metadataForm">
  <p><label for="companyName">Company Name:</label><input type="text" name="companyName" id="companyName"/></p>
  <p><label for="policyName">Policy  Name:</label><input type="text" name="policyName" id="policyName"/></p>
  <p><input type="submit" name="metadataSubmit" id="metadataSubmit" value="Submit"/></p>
</form>
