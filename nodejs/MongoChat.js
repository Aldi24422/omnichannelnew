require("dotenv").config({path: ".env",});
const mongodb = require('mongodb');
const MongoClient = mongodb.MongoClient;

async function findMongo(collectionName, query,projectionData,findOne = false, sort = {}) {
    const uri = `mongodb://${process.env.MONGODBIP_DEV}:${process.env.MONGODBPORT_DEV}/omnichannel`;
    const client = new MongoClient(uri);
    try {
        await client.connect();
        const collection = client.db().collection(collectionName);  
        var result = ""
        if (findOne) {
         result = projectionData 
                ? await collection.findOne(query, { projection: projectionData }).toArray()
                : await collection.findOne(query).toArray();
        } else {
            result = projectionData 
                ? await collection.find(query).sort(sort).project(projectionData).toArray()
                : await collection.find(query).sort(sort).toArray();
            }    
        return result;
      } catch (error) {
        console.log(error);
      } finally {
        await client.close();
    }
}

async function skipLimit(sekip,luimit,collectionName,db){
    const uri = `mongodb://${process.env.MONGODBIP_DEV}:${process.env.MONGODBPORT_DEV}/${db}`;
    const client = new MongoClient(uri);
    try {
        await client.connect();
        const collection = client.db().collection(collectionName);  
        var result = await collection.find().skip(sekip).limit(luimit).toArray();
        return result;
    } catch (error) {
        console.log(error)
    } finally {
        await client.close();
    }
}

// async function skipLimitOfficer(query,sekip,luimit,collectionName,db){
//     const uri = `mongodb://${process.env.MONGODBIP_DEV}:${process.env.MONGODBPORT_DEV}/${db}`;
//     const client = new MongoClient(uri);
//     try {
//         await client.connect();
//         const collection = client.db().collection(collectionName);  
//         var result = await collection.find(query).skip(sekip).limit(luimit).toArray();
//         return result;
//     } catch (error) {
//         console.log(error)
//     } finally {
//         await client.close();
//     }
// }

async function skipLimitOfficer(query, skip, limit, collectionName, db, sort = {}) {
    const uri = `mongodb://${process.env.MONGODBIP_DEV}:${process.env.MONGODBPORT_DEV}/${db}`;
    const client = new MongoClient(uri);
    try {
        await client.connect();
        const collection = client.db().collection(collectionName);  
        const result = await collection.find(query).sort(sort).skip(skip).limit(limit).toArray();
        return result;
    } catch (error) {
        console.log(error);
    } finally {
        await client.close();
    }
}


async function countDocuments(query, collectionName, dbName) {
    const uri = `mongodb://${process.env.MONGODBIP_DEV}:${process.env.MONGODBPORT_DEV}/${dbName}`;
    const client = new MongoClient(uri);
    try {
        await client.connect();
        const collection = client.db().collection(collectionName);
        const count = await collection.countDocuments(query);
        return count;
    } catch (error) {
        console.log(`Error in countDocuments: ${error.message}`);
        throw error; // Pastikan kesalahan dilempar agar bisa ditangani di luar
    } finally {
        await client.close();
    }
}


async function updateDocument(collectionName,documentId, updateData) {
    const uri = `mongodb://${process.env.MONGODBIP_DEV}:${process.env.MONGODBPORT_DEV}/omnichannel`;
    const client_primary = new MongoClient(uri);
    try {
      await client_primary.connect();
      const db = client_primary.db();
      const collection = db.collection(collectionName);
      const query = { _id: documentId };
      const result = await collection.updateOne(query, updateData);
      return result;
    } catch (err) {
      console.log('Error updating document', err);
    } finally {
      await client_primary.close();
    }
}

async function insertDocument(collectionName, insertData) {
    const uri = `mongodb://${process.env.MONGODBIP_DEV}:${process.env.MONGODBPORT_DEV}/omnichannel`;
    const client_primary = new MongoClient(uri);
    try {
        await client_primary.connect();
        const db = client_primary.db();
        const collection = db.collection(collectionName);
        const result = await collection.insertOne(insertData);
        return result;
    } catch (err) {
        throw err;
    } finally {
        await client_primary.close();
    }
}

async function getProgress() {
    const uri = `mongodb://${process.env.MONGODBIP_DEV}:${process.env.MONGODBPORT_DEV}/omnichannel`;
    const client = new MongoClient(uri);
    try {
        await client.connect();
        const database = client.db('omnichannel');
        const collection = database.collection('ChatRoom');
        const result = await collection.find({}, { _id: 0, remarksChat: 1 }).toArray();
        // Hitung jumlah "Ada Pesan Baru" dan jumlah selain itu
        let countBelumDitanggapi = 0;
        let countSelesai = 0;
        result.forEach((item) => {
            if (item.remarksChat === "Ada Pesan Baru") {
                countBelumDitanggapi++;
            } else {
                countSelesai++;
            }
        });
        return { countBelumDitanggapi, countSelesai };
    } catch (error) {
        console.log(error);
        throw new Error('Failed to fetch WhatsApp message remarks from MongoDB');
    } finally {
        await client.close();
    }
}

// Ekspor semua fungsi
module.exports = {
    findMongo,
    updateDocument,
    insertDocument,
    skipLimit,
    getProgress,
    skipLimitOfficer,
    countDocuments
};
