const fs = require('fs');
const path = require('path');
const { parse } = require('csv-parse/sync');
const nedb = require('nedb');
const https = require('https');

class DB {
    constructor() {
        this.db = new nedb({ inMemoryOnly: true });
    }

    importFromCSV(filePath, columnDef) {
        const csvData = fs.readFileSync(filePath, 'utf8');
        const records = parse(csvData, { columns: columnDef, skip_empty_lines: true });

        this.db.insert(records, (err, newDocs) => {
            if (err) {
                console.error('Error seeding database from CSV:', err);
            } 
            else {
                console.log(`Inserted ${newDocs.length} documents from CSV file`);
            }
        });
    }

    importFromURL(exampleDBUrl, columnDef) {
        return new Promise((resolve, reject) => {
            https.get(exampleDBUrl, (res) => {
                let data = '';

                res.on('data', (chunk) => {
                    data += chunk;
                });

                res.on('end', () => {
                    const records = parse(data, { columns: columnDef, skip_empty_lines: true });
                    this.db.insert(records, (err, newDocs) => {
                        if (err) {
                            console.error('Error importing example database:', err);
                            reject(err);
                        } 
                        else {
                            console.log(`Imported ${newDocs.length} documents from example database`);
                            resolve();
                        }
                    });
                });
            }).on('error', (err) => {
                console.error('Error importing example database:', err);
                reject(err);
            });
        });
    }

    classify(classInstance) {
        return new Promise((resolve, reject) => {
            this.findAll((err, table) => {
                if (err) {
                    console.error('Error finding documents:', err);
                    reject(err);
                } 
                else {
                    resolve( table.map(row => {
                        const args = Object.keys(new classInstance).map(prop => row[prop]);
                        return new classInstance(...args);
                    }));
                }
            });
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