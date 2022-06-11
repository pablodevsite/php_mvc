<phpsection_title>
la mia pagina home
</phpsection_title>


<phpsection_style>
<style>

</style>
</phpsection_style>


<phpsection_content>
<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
    {{message}}
<?php endif; ?>

<form method="POST" action="<?php $this->url("/formtest") ?>">
    <label>name</label>
    <input name="name" value="<?php $this->old('name', ''); ?>" />
    <br /><br />
    <label>surname</label>
    <input name="surname" value="" />
    <input type="submit" value="submit" />
</form>

</phpsection_content>


<phpsection_script>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        //alert("ciao")
    });
</script>
</phpsection_script>
