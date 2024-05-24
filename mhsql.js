/*

MIT License

Copyright (c) 2024 Mohamed Abdelsalam Ahmed Khalil Heddaya

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE. 

*/

async function mh_REQ(mh_f,mh_snd){
if(mh_snd==null||typeof mh_snd=="undefined"){mh_snd=null;};

return fetch(`${mh_f}.php`,{method:"POST",body:JSON.stringify(mh_snd),headers:{"Content-Type":"application/json"}})
.then(mh_resp => mh_resp.json()).then(mh_data => mh_data)
.catch(mh_error => console.error("MH REQ FAIL :",mh_error));

};

async function mh_REQH(mh_f,mh_h,mh_snd){
if(mh_snd==null||typeof mh_snd=="undefined"){mh_snd={};};

fetch(`${mh_f}.php`,{method:"POST",body:JSON.stringify(mh_snd),headers:{"Content-Type":"application/json"}})
.then(mh_resp => mh_resp.json()).then(mh_data => mh_h(mh_data))
.catch(mh_error => console.warn("MH REQH SWITCH TO mh_LOGS FOR SUITABLE RESPONSES!"));

};

async function mh_LOGS(mh_f,mh_h,mh_snd){
if(mh_snd==null||typeof mh_snd=="undefined"){mh_snd={};};

fetch(`${mh_f}.php`,{method:"POST",body:JSON.stringify(mh_snd),headers:{"Content-Type":"application/json"}})
.then(mh_resp => mh_resp.text()).then(mh_data => mh_h(mh_data))
.catch(mh_error => console.error("MH LOGS FAIL :",mh_error));

};

async function mh_RTXT(mh_f,mh_h,mh_snd){
if(mh_snd==null||typeof mh_snd=="undefined"){mh_snd={};};

fetch(`${mh_f}.php`,{method:"POST",body:JSON.stringify(mh_snd),headers:{"Content-Type":"application/json"}})
.then(mh_resp => mh_resp.text()).then(mh_data => mh_h(mh_data))
.catch(mh_error => console.error("MH RTXT FAIL :",mh_error));

};
