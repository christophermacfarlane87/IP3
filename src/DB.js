const fs = require('fs');
const path = require('path');
const parse = require('csv-parse/lib/sync');
const nedb = require('nedb');
const https = require('https');

class DB {
    constructor() {
        this.db = new nedb({ inMemoryOnly: true });
    }

    importFromCSV(filePath) {
        const csvData = fs.readFileSync(filePath, 'utf8');
        const records = parse(csvData, { columns: true, skip_empty_lines: true });

        this.db.insert(records, (err, newDocs) => {
            if (err) {
                console.error('Error seeding database from CSV:', err);
            } 
            else {
                console.log(`Inserted ${newDocs.length} documents from CSV file`);
            }
        });
    }

    importFromURL(exampleDBUrl) {
        https.get(exampleDBUrl, (res) => {
            let data = '';

            res.on('data', (chunk) => {
                data += chunk;
            });

            res.on('end', () => {
                const records = parse(data, { columns: true, skip_empty_lines: true });
                this.db.insert(records, (err, newDocs) => {
                    if (err) {
                        console.error('Error importing example database:', err);
                    } 
                    else {
                        console.log(`Imported ${newDocs.length} documents from example database`);
                    }
                });
            });
        }).on('error', (err) => {
            console.error('Error importing example database:', err);
        });
    }

    findAll(callback) {
        this.db.find({}, callback);
    }

    insert(doc, callback) {
        this.db.insert(doc, callback);
    }

    update(query, updateDoc, options, callback) {
        this.db.update(query, updateDoc, options, callback);
    }

    remove(query, options, callback) {
        this.db.remove(query, options, callback);
    }
}

module.exports = DB;