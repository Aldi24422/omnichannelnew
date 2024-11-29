const { Client } = require("whatsapp-web.js");
const express = require("express");
const cors = require("cors");

const app = express();
const port = 3000;

const mysql = require("mysql2");

// Konfigurasi koneksi database
const db = mysql.createConnection({
  host: "localhost", // Ganti sesuai konfigurasi
  user: "root", // Username database
  password: "", // Password database
  database: "chatbot_omnichannel", // Nama database
});

// Cek koneksi
db.connect((err) => {
  if (err) {
    console.error("Error connecting to the database:", err);
  } else {
    console.log("Connected to the database.");
  }
});

app.use(cors()); // Allow cross-origin requests

let qrCodeData = ""; // Variable to store the QR code

const client = new Client();

// Event: QR code generated
client.on("qr", (qr) => {
  console.log("QR Received");
  qrCodeData = qr; // Store QR code
});

// Event: Client ready
client.on("ready", () => {
  console.log("Client is ready!");
});

// REST endpoint to fetch the QR code
app.get("/qr", (req, res) => {
  if (qrCodeData) {
    res.json({ success: true, qr: qrCodeData });
  } else {
    res.json({ success: false, message: "QR code not available yet." });
  }
});

client.initialize();

app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});

const getAnswer = async (keyword) => {
  const query = "SELECT jawaban FROM pertanyaan WHERE keyword = ?";
  try {
    console.log("Executing query:", query, "with keyword:", keyword); // Log query dan keyword
    const [results] = await db.promise().query(query, [keyword]);
    console.log("Query results:", results); // Log hasil query

    if (results.length > 0) {
      return results[0].jawaban; // Kirim jawaban yang ditemukan
    } else {
    }
  } catch (err) {
    console.error("Database query error:", err); // Log error detail
    return "Terjadi kesalahan pada server.";
  }
};

client.on("message", async (msg) => {
  const userMessage = msg.body.trim().toLowerCase(); // Normalize pesan
  console.log("User message:", userMessage); // Log pesan pengguna

  const response = await getAnswer(userMessage); // Dapatkan jawaban dari database
  console.log("Response:", response); // Log respons sebelum dikirim

  msg.reply(response); // Kirimkan jawaban ke pengguna
});
