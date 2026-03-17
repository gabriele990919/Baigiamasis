<h2>Create Story</h2>

<form method="POST" action="/store">

@csrf

<textarea name="content" placeholder="Story text"></textarea>

<br><br>

<input type="number" name="target_amount" placeholder="Target amount">

<br><br>

<button>Create</button>

</form>