const chunkSize = 64 * 1024 * 1024;
let hasher = null;

function hashChunk(chunk) {
    return new Promise((resolve) => {
        const fileReader = new FileReader();
        fileReader.onload = async (e) => {
            const view = new Uint8Array(e.target.result);
            hasher.update(view);
            resolve();
        };
        fileReader.readAsArrayBuffer(chunk);
    });
}

export const readFile = async (file, currentAlgorithm) => {
    if (!hasher) {
        switch (currentAlgorithm) {
            case 'md5':
                hasher = await hashwasm.createMD5();
                break;
            case 'sha1':
                hasher = await hashwasm.createSHA1();
                break;
            case 'crc32':
                hasher = await hashwasm.createCRC32();
                break;
            default:
                throw new Error("Unsupported algorithm");
        }
    } else {
        hasher.init();
    }

    const chunkNumber = Math.floor(file.size / chunkSize);
    for (let i = 0; i <= chunkNumber; i++) {
        const chunk = file.slice(
            chunkSize * i,
            Math.min(chunkSize * (i + 1), file.size)
        );
        await hashChunk(chunk);
    }

    const hash = hasher.digest(); // Получаем итоговый хеш
    hasher = null; // Сбрасываем хешер после вычисления

    return hash; // Возвращаем итоговый хеш
};

// export function getHash() {
//     const chunkSize = 64 * 1024 * 1024;
//     const fileReader = new FileReader();
//     let hasher = null;

//     function hashChunk(chunk) {
//         return new Promise((resolve, reject) => {
//             fileReader.onload = async (e) => {
//                 const view = new Uint8Array(e.target.result);
//                 hasher.update(view);
//                 resolve();
//             };

//             fileReader.readAsArrayBuffer(chunk);
//         });
//     }

//     const readFile = async (file) => {
//         if (hasher) {
//             hasher.init();
//         } else {
//             hasher = await hashwasm.createMD5();
//             // hasher = await hashwasm.createSHA1();
//             // hasher = await hashwasm.createCRC32();
//         }

//         const chunkNumber = Math.floor(file.size / chunkSize);

//         for (let i = 0; i <= chunkNumber; i++) {
//             const chunk = file.slice(
//                 chunkSize * i,
//                 Math.min(chunkSize * (i + 1), file.size)
//             );
//             await hashChunk(chunk);
//         }

//         const hash = hasher.digest();
//         return Promise.resolve(hash);
//     };

//     const fileSelector = document.getElementById("inputFile");
//     const resultElement = document.getElementById("loadButton");

//     fileSelector.addEventListener("change", async (event) => {
//         const file = event.target.files[0];

//         resultElement.innerHTML = "Loading...";
//         const start = Date.now();
//         const hash = await readFile(file);
//         const end = Date.now();
//         const duration = end - start;
//         const fileSizeMB = file.size / 1024 / 1024;
//         const throughput = fileSizeMB / (duration / 1000);
//         console.log(`
//                   Hash: ${hash}<br>
//                   Duration: ${duration} ms<br>
//                   Throughput: ${throughput.toFixed(2)} MB/s
//               `);
//         resultElement.innerHTML = "Сформировать";
//     });
// }
