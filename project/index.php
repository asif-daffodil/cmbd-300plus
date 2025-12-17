<?php  
    require_once 'header.php';
    require_once './components/home/hero.php';
    require_once './components/home/product-list.php';
?>
    
<script>
    <?php if (isset($_GET['addtocart']) && $_GET['addtocart'] === 'true') { ?>
        Swal.fire({
        icon: 'success',
        title: 'Added to Cart',
        text: 'The product has been added to your cart successfully.',
        timer: 2000,
        showConfirmButton: false
    }).then(() => {
        const url = new URL(window.location);
        url.searchParams.delete('addtocart');
        location.href = url.toString();
    });
    <?php } ?>
</script>
<?php
    require_once 'footer.php';
?>