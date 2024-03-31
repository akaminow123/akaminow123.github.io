
Folder name: <input type="text" id="dir" />

File name: <input type="text" id="file" />

Input file: <input type="file" id="inp" onchange="readFile('inp')" /><br />
<p class="inp"></p>

<button onclick="gen_pf()">submit</button>

<p id="password"></p>



Pub: <input type="file" id="pub" onchange="readFile('pub')" /><br />
<p class="pub"></p>
Proof: <input type="file" id="pf" onchange="readFile('pf')" /><br />
<p class="pf"></p>

<script src=" https://cdn.jsdelivr.net/npm/snarkjs@0.7.3/build/snarkjs.min.js "></script>

<script>

const password = document.getElementById("password");
var input_text;

function readFile(id) {

    const [file] = document.querySelector("input[id=" + id + "]").files;
    const reader = new FileReader();

    reader.onload = function(e) { 
        var result = JSON.parse(e.target.result);
        var formatted = JSON.stringify(result, null, 24);
            // document.querySelector('.' + id).innerText = formatted;
            input_text = formatted;
      }

      reader.readAsText(file);
    }

async function gen_pf() {
const { proof, publicSignals } = await snarkjs.groth16.fullProve(
  {input_text});
pub.innerText = publicSignals;
pf.innerText = proof;
}
</script>
