require("dotenv").config({ path: ".env" });
const express = require('express');
const app = express();
const bodyParser = require('body-parser');
const port = process.env.API_PORT;

const mongodb = require('mongodb');
const MongoClient = mongodb.MongoClient;
const urlMongodb = `mongodb://${process.env.MONGODBIP_DEV}:${process.env.MONGODBPORT_DEV}/${process.env.MONGODBNAME_DEV}`;
const clientMongodb = new MongoClient(urlMongodb);


const urlMongodb_production = `mongodb://${process.env.MONGODBIP_PRODUCTION}:${process.env.MONGODBPORT_PRODUCTION}/${process.env.MONGODBNAME_PRODUCTION}`;
const clientMongodb_production = new MongoClient(urlMongodb_production);

app.set('json spaces', 40);
app.use(bodyParser.json());
app.listen(port, () => {
    console.log(`omnichannel listening at port ${port}`)
});

// async function start(params) {
//    try {
//     const chatroomByUser = await clientMongodb_production.db().collection("Users").
//     find({ 
//         roleId: { $in: ["a88db7f4-307b-496e-8129-dd19ff5f1632","WARGA","c9bdca3a-6560-40ab-9ede-1f62b2d78c00"]},
//         status: "Aktif"
//     })
//     .toArray();
//     console.log(chatroomByUser.length)
//    } catch (error) {
//     console.log(error)
//    } 
// }

// start();

app.get("/get_all_contact/:user/:limit/:skip", async (req, res) => {
    try {
        await clientMongodb.connect();
        let username = req.params.user;
        let limit = parseInt(req.params.limit);
        let skip = parseInt(req.params.skip);

        // const chatroomByUser = await clientMongodb.db().collection("ChatRoom").find({ 
        //     officer: username
        // }).sort({ 
        //     _updatedAt: -1 
        // }).skip(skip).limit(limit).toArray();

        const chatroomByUser = await clientMongodb.db().collection("ChatRoom").aggregate([
            // { $match: { officer: username } },
            { $unwind: "$message" },
            { $sort: { "message._createdAt": -1 } },
            { $skip: skip },
            { $limit: limit }
        ]).skip(skip).limit(limit).toArray();
        const modifiedDataArray = chatroomByUser.map(item => {
            return {
                ...item, // Salin properti asli
                message: item.message.content.length > 20 
                ? item.message.content.substring(0, 20) + '...' // Potong teks jika lebih dari 12 karakter
                : item.message.content
            };
        });
        res.status(200).json({
            status: 200,
            totalData: chatroomByUser.length,
            data: modifiedDataArray
        });
    } catch (error) {
        console.log(`Error occurred: ${error.message}`);
        res.status(500).json({
            status: 500,
            message: error.message
        });
    } finally {
        await clientMongodb.close();
    }
});