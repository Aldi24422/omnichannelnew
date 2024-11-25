const { Client } = require('whatsapp-web.js');
const express = require('express');
const cors = require('cors');

const app = express();
const port = 3000;

app.use(cors()); // Allow cross-origin requests

let qrCodeData = ''; // Variable to store the QR code

const client = new Client();

// Event: QR code generated
client.on('qr', (qr) => {
    console.log('QR Received');
    qrCodeData = qr; // Store QR code
});

// Event: Client ready
client.on('ready', () => {
    console.log('Client is ready!');
});

// REST endpoint to fetch the QR code
app.get('/qr', (req, res) => {
    if (qrCodeData) {
        res.json({ success: true, qr: qrCodeData });
    } else {
        res.json({ success: false, message: 'QR code not available yet.' });
    }
});

client.initialize();

// Start Express server
app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
});
