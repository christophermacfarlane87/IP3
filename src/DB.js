const fs = require('fs');
const path = require('path');
const { parse } = require('csv-parse/sync');
const nedb = require('nedb');
const https = require('https');

class DB {
    constructor() {
        this.db = new nedb({ inMemoryOnly: true });
    }

    downloadCSV(csvUrl) {
        return new Promise((resolve, reject) => {
            https.get(csvUrl, (res) => {
                let csvData = '';

                res.on('data', (chunk) => {
                    csvData += chunk;
                });

                res.on('end', () => {
                    this.importFromCSV(csvData)
                    .then(resolve)
                    .catch(reject);
                });
            }).on('error', (err) => {
                console.error('Error downloading CSV:', err);
                reject(err);
            });
        });
    }

    localCSV(filePath) {
        return new Promise((resolve) => {
            const csvData = fs.readFileSync(filePath, 'utf8');
            this.importFromCSV(csvData);
            resolve();
        })
    }

    importFromCSV(csvData) {
        return new Promise((resolve, reject) => {
            const records = parse(csvData, {
                columns: true,
                skip_empty_lines: true,
                cast: (value, context) => {
                    if (context.column === 'ingredients' || context.column === 'items') {
                        const ingredientsArray = JSON.parse(value);
                        const ingredientsMap = new Map();

                        for (let i = 0; i < ingredientsArray.length; i += 2) {
                            ingredientsMap.set(ingredientsArray[i], parseFloat(ingredientsArray[i + 1]));
                        }

                        return Object.fromEntries(ingredientsMap);
                    } 
                    else {
                        return value;
                    }
                }
            });

            this.db.insert(records, (err, newDocs) => {
                if (err) {
                    console.error('Error seeding database from CSV:', err);
                    reject(err);
                } 
                else {
                    console.log(`Inserted ${newDocs.length} documents from CSV file`);
                    resolve();
                }
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

    exportCSV(classArray) {
        // TODO
    }

    exportNEDB(classArray) {
        // TODO
    }

    localBackup(classArray, type) {
        // TODO
    }

    cloudBackup(classArray, type) {
        // TODO
    }

    findOne(callback) {
        this.db.findOne({}, callback);
    }
	
	findQuery(query, callback) {
		this.db.find(query, callback);
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