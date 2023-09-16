@if (session('message'))
    <p>{{ session('message') }}</p>
@endif

<form method="POST" action="/mail/send">
    @csrf
    <label for="email">Alamat Email Penerima:</label>
    <input type="email" name="email" required><br><br>
    <label for="subject">Subjek Email:</label>
    <input type="text" name="subject" required><br><br>
    <label for="message">Isi Pesan:</label><br>
    <textarea name="message" rows="4" cols="50" required></textarea><br><br>
    <button type="submit">Kirim Email</button>
</form>
