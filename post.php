<?php include_once 'inc/header.php'; ?>
<?php
	if (!isset($_GET['id']) || $_GET['id'] == NULL) {
		header("Location:404.php");
	}else {
		$id = $_GET['id'];
	}
 ?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php
					$query = "SELECT * FROM tbl_post WHERE id = $id";
					$post = $db->select($query);
					if ($post) {
						while ($result = $post->fetch_assoc()) {

				 ?>
				<h2><?php echo $result['title']; ?></h2>
				<h4><?php echo $fm->formatDate($result['date']); ?>, By <?php echo $result['author']; ?></h4>
				<img src="admin/<?php echo $result['image']; ?>" alt="MyImage"/>
				<p><?php echo $result['body']; ?></p>

				<div id="disqus_thread"></div>
		<script>

		/**
		*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
		*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
		/*
		var disqus_config = function () {
		this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
		this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
		};
		*/
		(function() { // DON'T EDIT BELOW THIS LINE
		var d = document, s = d.createElement('script');
		s.src = 'https://onlyone8.disqus.com/embed.js';
		s.setAttribute('data-timestamp', +new Date());
		(d.head || d.body).appendChild(s);
		})();
		</script>
		<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>



				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php
						$catid = $result['cat'];
						$queryrelated = "SELECT * FROM tbl_post WHERE cat = '$catid' ORDER BY rand() LIMIT 6";
						$relatedpost = $db->select($queryrelated);
						if ($relatedpost) {
							while ($rresult = $relatedpost->fetch_assoc()) {

					 ?>
					<a href="post.php?id=<?php echo $rresult['id']; ?>"><img src="admin/<?php echo $rresult['image']; ?>" alt="post image"/></a>
					<?php } ?>
					<?php
						}else {
							echo "No related post found.";
						}
					 ?>
				</div>



				<?php } ?>
				<?php
					}else {
						header("location:404.php");
					}
				 ?>
			</div>

		</div>
		<?php include_once 'inc/sidebar.php'; ?>
	</div>

<?php include_once 'inc/footer.php'; ?>
