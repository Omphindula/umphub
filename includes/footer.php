<footer class="py-5">
  <div class="container">
    <p class="m-0 text-center text-white">
      Copyright &copy; UMPHub <?php echo date('Y'); ?>
    </p>
  </div>
</footer>

<style>
  footer {
    background-color: #141738; /* Updated to a proper blue color */
    padding: 20px 0;
    border-radius:12;
  }

  footer p {
    font-size: 1.2rem;
    margin: 0;
    color: #ffffff; /* White text for better contrast */
    transition: color 0.3s ease;
  }

  footer p:hover {
    color: #cceeff; /* Lighten the text color on hover */
  }

  @media (max-width: 768px) {
    footer p {
      font-size: 1rem; /* Adjust font size for smaller screens */
    }
  }
</style>
