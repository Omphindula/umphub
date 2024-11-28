<footer class="py-5">
    <div class="container">
        <p class="m-0 text-center text-white">
            Copyright &copy; UMPHub <?php echo date('Y'); ?>
        </p>
    </div>
</footer>

<style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh; /* Ensure the body takes at least full viewport height */
        margin: 0;
    }

    .container {
        flex: 1; /* Make the container take up all available space */
    }

    footer {
        background-color: #141738;
        color: white;
        padding: 10px;
        width: 100%;
        position: relative; 
        text-align: center;
        z-index: 999; /* Ensures the footer is above other elements if needed */
        box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1); /* Optional shadow for style */
    }
</style>
